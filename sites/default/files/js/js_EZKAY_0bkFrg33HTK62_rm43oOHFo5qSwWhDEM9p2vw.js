/**
 * @file
 * Provides JavaScript additions to the managed file field type.
 *
 * This file provides progress bar support (if available), popup windows for
 * file previews, and disabling of other file fields during Ajax uploads (which
 * prevents separate file fields from accidentally uploading files).
 */

(function ($, Drupal) {
  /**
   * Attach behaviors to the file fields passed in the settings.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches validation for file extensions.
   * @prop {Drupal~behaviorDetach} detach
   *   Detaches validation for file extensions.
   */
  Drupal.behaviors.fileValidateAutoAttach = {
    attach(context, settings) {
      const $context = $(context);
      let elements;

      function initFileValidation(selector) {
        $(once('fileValidate', $context.find(selector))).on(
          'change.fileValidate',
          { extensions: elements[selector] },
          Drupal.file.validateExtension,
        );
      }

      if (settings.file && settings.file.elements) {
        elements = settings.file.elements;
        Object.keys(elements).forEach(initFileValidation);
      }
    },
    detach(context, settings, trigger) {
      const $context = $(context);
      let elements;

      function removeFileValidation(selector) {
        $(once.remove('fileValidate', $context.find(selector))).off(
          'change.fileValidate',
          Drupal.file.validateExtension,
        );
      }

      if (trigger === 'unload' && settings.file && settings.file.elements) {
        elements = settings.file.elements;
        Object.keys(elements).forEach(removeFileValidation);
      }
    },
  };

  /**
   * Attach behaviors to file element auto upload.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches triggers for the upload button.
   * @prop {Drupal~behaviorDetach} detach
   *   Detaches auto file upload trigger.
   */
  Drupal.behaviors.fileAutoUpload = {
    attach(context) {
      $(once('auto-file-upload', 'input[type="file"]', context)).on(
        'change.autoFileUpload',
        Drupal.file.triggerUploadButton,
      );
    },
    detach(context, settings, trigger) {
      if (trigger === 'unload') {
        $(once.remove('auto-file-upload', 'input[type="file"]', context)).off(
          '.autoFileUpload',
        );
      }
    },
  };

  /**
   * Attach behaviors to the file upload and remove buttons.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches form submit events.
   * @prop {Drupal~behaviorDetach} detach
   *   Detaches form submit events.
   */
  Drupal.behaviors.fileButtons = {
    attach(context) {
      const $context = $(context);
      $context
        .find('.js-form-submit')
        .on('mousedown', Drupal.file.disableFields);
      $context
        .find('.js-form-managed-file .js-form-submit')
        .on('mousedown', Drupal.file.progressBar);
    },
    detach(context, settings, trigger) {
      if (trigger === 'unload') {
        const $context = $(context);
        $context
          .find('.js-form-submit')
          .off('mousedown', Drupal.file.disableFields);
        $context
          .find('.js-form-managed-file .js-form-submit')
          .off('mousedown', Drupal.file.progressBar);
      }
    },
  };

  /**
   * Attach behaviors to links within managed file elements for preview windows.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches triggers.
   * @prop {Drupal~behaviorDetach} detach
   *   Detaches triggers.
   */
  Drupal.behaviors.filePreviewLinks = {
    attach(context) {
      $(context)
        .find('div.js-form-managed-file .file a')
        .on('click', Drupal.file.openInNewWindow);
    },
    detach(context) {
      $(context)
        .find('div.js-form-managed-file .file a')
        .off('click', Drupal.file.openInNewWindow);
    },
  };

  /**
   * File upload utility functions.
   *
   * @namespace
   */
  Drupal.file = Drupal.file || {
    /**
     * Client-side file input validation of file extensions.
     *
     * @name Drupal.file.validateExtension
     *
     * @param {jQuery.Event} event
     *   The event triggered. For example `change.fileValidate`.
     */
    validateExtension(event) {
      event.preventDefault();
      // Remove any previous errors.
      $('.file-upload-js-error').remove();

      // Add client side validation for the input[type=file].
      const extensionPattern = event.data.extensions.replace(/,\s*/g, '|');
      if (extensionPattern.length > 1 && this.value.length > 0) {
        const acceptableMatch = new RegExp(`\\.(${extensionPattern})$`, 'gi');
        if (!acceptableMatch.test(this.value)) {
          const error = Drupal.t(
            'The selected file %filename cannot be uploaded. Only files with the following extensions are allowed: %extensions.',
            {
              // According to the specifications of HTML5, a file upload control
              // should not reveal the real local path to the file that a user
              // has selected. Some web browsers implement this restriction by
              // replacing the local path with "C:\fakepath\", which can cause
              // confusion by leaving the user thinking perhaps Drupal could not
              // find the file because it messed up the file path. To avoid this
              // confusion, therefore, we strip out the bogus fakepath string.
              '%filename': this.value.replace('C:\\fakepath\\', ''),
              '%extensions': extensionPattern.replace(/\|/g, ', '),
            },
          );
          $(this)
            .closest('div.js-form-managed-file')
            .prepend(
              `<div class="messages messages--error file-upload-js-error" aria-live="polite">${error}</div>`,
            );
          this.value = '';
          // Cancel all other change event handlers.
          event.stopImmediatePropagation();
        }
      }
    },

    /**
     * Trigger the upload_button mouse event to auto-upload as a managed file.
     *
     * @name Drupal.file.triggerUploadButton
     *
     * @param {jQuery.Event} event
     *   The event triggered. For example `change.autoFileUpload`.
     */
    triggerUploadButton(event) {
      $(event.target)
        .closest('.js-form-managed-file')
        .find('.js-form-submit[data-drupal-selector$="upload-button"]')
        .trigger('mousedown');
    },

    /**
     * Prevent file uploads when using buttons not intended to upload.
     *
     * @name Drupal.file.disableFields
     *
     * @param {jQuery.Event} event
     *   The event triggered, most likely a `mousedown` event.
     */
    disableFields(event) {
      const $clickedButton = $(this);
      $clickedButton.trigger('formUpdated');

      // Check if we're working with an "Upload" button.
      let $enabledFields = [];
      if ($clickedButton.closest('div.js-form-managed-file').length > 0) {
        $enabledFields = $clickedButton
          .closest('div.js-form-managed-file')
          .find('input.js-form-file');
      }

      // Temporarily disable upload fields other than the one we're currently
      // working with. Filter out fields that are already disabled so that they
      // do not get enabled when we re-enable these fields at the end of
      // behavior processing. Re-enable in a setTimeout set to a relatively
      // short amount of time (1 second). All the other mousedown handlers
      // (like Drupal's Ajax behaviors) are executed before any timeout
      // functions are called, so we don't have to worry about the fields being
      // re-enabled too soon. @todo If the previous sentence is true, why not
      // set the timeout to 0?
      const $fieldsToTemporarilyDisable = $(
        'div.js-form-managed-file input.js-form-file',
      )
        .not($enabledFields)
        .not(':disabled');
      $fieldsToTemporarilyDisable.prop('disabled', true);
      setTimeout(() => {
        $fieldsToTemporarilyDisable.prop('disabled', false);
      }, 1000);
    },

    /**
     * Add progress bar support if possible.
     *
     * @name Drupal.file.progressBar
     *
     * @param {jQuery.Event} event
     *   The event triggered, most likely a `mousedown` event.
     */
    progressBar(event) {
      const $clickedButton = $(this);
      const $progressId = $clickedButton
        .closest('div.js-form-managed-file')
        .find('input.file-progress');
      if ($progressId.length) {
        const originalName = $progressId.attr('name');

        // Replace the name with the required identifier.
        $progressId.attr(
          'name',
          originalName.match(/APC_UPLOAD_PROGRESS|UPLOAD_IDENTIFIER/)[0],
        );

        // Restore the original name after the upload begins.
        setTimeout(() => {
          $progressId.attr('name', originalName);
        }, 1000);
      }
      // Show the progress bar if the upload takes longer than half a second.
      setTimeout(() => {
        $clickedButton
          .closest('div.js-form-managed-file')
          .find('div.ajax-progress-bar')
          .slideDown();
      }, 500);
      $clickedButton.trigger('fileUpload');
    },

    /**
     * Open links to files within forms in a new window.
     *
     * @name Drupal.file.openInNewWindow
     *
     * @param {jQuery.Event} event
     *   The event triggered, most likely a `click` event.
     */
    openInNewWindow(event) {
      event.preventDefault();
      $(this).attr('target', '_blank');
      window.open(
        this.href,
        'filePreview',
        'toolbar=0,scrollbars=1,location=1,statusbar=1,menubar=0,resizable=1,width=500,height=550',
      );
    },
  };
})(jQuery, Drupal);
;
/**
 * @file
 * Text behaviors.
 */

(function ($, Drupal) {
  /**
   * Auto-hide summary textarea if empty and show hide and unhide links.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches auto-hide behavior on `text-summary` events.
   */
  Drupal.behaviors.textSummary = {
    attach(context, settings) {
      once('text-summary', '.js-text-summary', context).forEach((summary) => {
        const $widget = $(summary).closest('.js-text-format-wrapper');

        const $summary = $widget.find('.js-text-summary-wrapper');
        const $summaryLabel = $summary.find('label').eq(0);
        const $full = $widget.children('.js-form-type-textarea');
        let $fullLabel = $full.find('label').eq(0);

        // Create a placeholder label when the field cardinality is greater
        // than 1.
        if ($fullLabel.length === 0) {
          $fullLabel = $('<label></label>').prependTo($full);
        }

        // To ensure the summary toggle is shown in case the label is hidden
        // (in multivalue fields in particular), show the label but hide
        // the original text of the label.
        if ($fullLabel.hasClass('visually-hidden')) {
          $fullLabel.html(
            (index, oldHtml) =>
              `<span class="visually-hidden">${oldHtml}</span>`,
          );
          $fullLabel.removeClass('visually-hidden');
        }

        // Set up the edit/hide summary link.
        const $link = $(
          `<span class="field-edit-link"> (<button type="button" class="link link-edit-summary">${Drupal.t(
            'Hide summary',
          )}</button>)</span>`,
        );
        const $button = $link.find('button');
        let toggleClick = true;
        $link
          .on('click', (e) => {
            if (toggleClick) {
              $summary.hide();
              $button.html(Drupal.t('Edit summary'));
              $link.appendTo($fullLabel);
            } else {
              $summary.show();
              $button.html(Drupal.t('Hide summary'));
              $link.appendTo($summaryLabel);
            }
            e.preventDefault();
            toggleClick = !toggleClick;
          })
          .appendTo($summaryLabel);

        // If no summary is set, hide the summary field.
        if (summary.value === '') {
          $link.trigger('click');
        }
      });
    },
  };
})(jQuery, Drupal);
;
/**
 * @file
 * Builds a nested accordion widget.
 *
 * Invoke on an HTML list element with the jQuery plugin pattern.
 *
 * @example
 * $('.toolbar-menu').drupalToolbarMenu();
 */

(function ($, Drupal, drupalSettings) {
  /**
   * Store the open menu tray.
   */
  let activeItem = Drupal.url(drupalSettings.path.currentPath);

  $.fn.drupalToolbarMenu = function () {
    const ui = {
      handleOpen: Drupal.t('Extend'),
      handleClose: Drupal.t('Collapse'),
    };

    /**
     * Toggle the open/close state of a list is a menu.
     *
     * @param {jQuery} $item
     *   The li item to be toggled.
     *
     * @param {Boolean} switcher
     *   A flag that forces toggleClass to add or a remove a class, rather than
     *   simply toggling its presence.
     */
    function toggleList($item, switcher) {
      const $toggle = $item
        .children('.toolbar-box')
        .children('.toolbar-handle');
      switcher =
        typeof switcher !== 'undefined' ? switcher : !$item.hasClass('open');
      // Toggle the item open state.
      $item.toggleClass('open', switcher);
      // Twist the toggle.
      $toggle.toggleClass('open', switcher);
      // Adjust the toggle text.
      $toggle.find('.action').each((index, element) => {
        // Expand Structure, Collapse Structure.
        element.textContent = switcher ? ui.handleClose : ui.handleOpen;
      });
    }

    /**
     * Handle clicks from the disclosure button on an item with sub-items.
     *
     * @param {Object} event
     *   A jQuery Event object.
     */
    function toggleClickHandler(event) {
      const $toggle = $(event.target);
      const $item = $toggle.closest('li');
      // Toggle the list item.
      toggleList($item);
      // Close open sibling menus.
      const $openItems = $item.siblings().filter('.open');
      toggleList($openItems, false);
    }

    /**
     * Handle clicks from a menu item link.
     *
     * @param {Object} event
     *   A jQuery Event object.
     */
    function linkClickHandler(event) {
      // If the toolbar is positioned fixed (and therefore hiding content
      // underneath), then users expect clicks in the administration menu tray
      // to take them to that destination but for the menu tray to be closed
      // after clicking: otherwise the toolbar itself is obstructing the view
      // of the destination they chose.
      if (!Drupal.toolbar.models.toolbarModel.get('isFixed')) {
        Drupal.toolbar.models.toolbarModel.set('activeTab', null);
      }
      // Stopping propagation to make sure that once a toolbar-box is clicked
      // (the whitespace part), the page is not redirected anymore.
      event.stopPropagation();
    }

    /**
     * Add markup to the menu elements.
     *
     * Items with sub-elements have a list toggle attached to them. Menu item
     * links and the corresponding list toggle are wrapped with in a div
     * classed with .toolbar-box. The .toolbar-box div provides a positioning
     * context for the item list toggle.
     *
     * @param {jQuery} $menu
     *   The root of the menu to be initialized.
     */
    function initItems($menu) {
      const options = {
        class: 'toolbar-icon toolbar-handle',
        action: ui.handleOpen,
        text: '',
      };
      // Initialize items and their links.
      $menu.find('li > a').wrap('<div class="toolbar-box">');
      // Add a handle to each list item if it has a menu.
      $menu.find('li').each((index, element) => {
        const $item = $(element);
        if ($item.children('ul.toolbar-menu').length) {
          const $box = $item.children('.toolbar-box');
          const $link = $box.find('a');
          options.text = Drupal.t('@label', {
            '@label': $link.length ? $link[0].textContent : '',
          });
          $item
            .children('.toolbar-box')
            .append(Drupal.theme('toolbarMenuItemToggle', options));
        }
      });
    }

    /**
     * Adds a level class to each list based on its depth in the menu.
     *
     * This function is called recursively on each sub level of lists elements
     * until the depth of the menu is exhausted.
     *
     * @param {jQuery} $lists
     *   A jQuery object of ul elements.
     *
     * @param {number} level
     *   The current level number to be assigned to the list elements.
     */
    function markListLevels($lists, level) {
      level = !level ? 1 : level;
      const $lis = $lists.children('li').addClass(`level-${level}`);
      $lists = $lis.children('ul');
      if ($lists.length) {
        markListLevels($lists, level + 1);
      }
    }

    /**
     * On page load, open the active menu item.
     *
     * Marks the trail of the active link in the menu back to the root of the
     * menu with .menu-item--active-trail.
     *
     * @param {jQuery} $menu
     *   The root of the menu.
     */
    function openActiveItem($menu) {
      const pathItem = $menu.find(`a[href="${window.location.pathname}"]`);
      if (pathItem.length && !activeItem) {
        activeItem = window.location.pathname;
      }
      if (activeItem) {
        const $activeItem = $menu
          .find(`a[href="${activeItem}"]`)
          .addClass('menu-item--active');
        const $activeTrail = $activeItem
          .parentsUntil('.root', 'li')
          .addClass('menu-item--active-trail');
        toggleList($activeTrail, true);
      }
    }

    // Return the jQuery object.
    return this.each(function (selector) {
      const menu = once('toolbar-menu', this);
      if (menu.length) {
        const $menu = $(menu);
        // Bind event handlers.
        $menu
          .on('click.toolbar', '.toolbar-box', toggleClickHandler)
          .on('click.toolbar', '.toolbar-box a', linkClickHandler);

        $menu.addClass('root');
        initItems($menu);
        markListLevels($menu);
        // Restore previous and active states.
        openActiveItem($menu);
      }
    });
  };

  /**
   * A toggle is an interactive element often bound to a click handler.
   *
   * @param {object} options
   *   Options for the button.
   * @param {string} options.class
   *   Class to set on the button.
   * @param {string} options.action
   *   Action for the button.
   * @param {string} options.text
   *   Used as label for the button.
   *
   * @return {string}
   *   A string representing a DOM fragment.
   */
  Drupal.theme.toolbarMenuItemToggle = function (options) {
    return `<button class="${options.class}"><span class="action">${options.action}</span> <span class="label">${options.text}</span></button>`;
  };
})(jQuery, Drupal, drupalSettings);
;
/**
 * @file
 * Defines the behavior of the Drupal administration toolbar.
 */

(function ($, Drupal, drupalSettings) {
  // Merge run-time settings with the defaults.
  const options = $.extend(
    {
      breakpoints: {
        'toolbar.narrow': '',
        'toolbar.standard': '',
        'toolbar.wide': '',
      },
    },
    drupalSettings.toolbar,
    // Merge strings on top of drupalSettings so that they are not mutable.
    {
      strings: {
        horizontal: Drupal.t('Horizontal orientation'),
        vertical: Drupal.t('Vertical orientation'),
      },
    },
  );

  /**
   * Registers tabs with the toolbar.
   *
   * The Drupal toolbar allows modules to register top-level tabs. These may
   * point directly to a resource or toggle the visibility of a tray.
   *
   * Modules register tabs with hook_toolbar().
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches the toolbar rendering functionality to the toolbar element.
   */
  Drupal.behaviors.toolbar = {
    attach(context) {
      // Verify that the user agent understands media queries. Complex admin
      // toolbar layouts require media query support.
      if (!window.matchMedia('only screen').matches) {
        return;
      }
      // Process the administrative toolbar.
      once('toolbar', '#toolbar-administration', context).forEach((toolbar) => {
        // Establish the toolbar models and views.
        const model = new Drupal.toolbar.ToolbarModel({
          locked: JSON.parse(
            localStorage.getItem('Drupal.toolbar.trayVerticalLocked'),
          ),
          activeTab: document.getElementById(
            JSON.parse(localStorage.getItem('Drupal.toolbar.activeTabID')),
          ),
          height: $('#toolbar-administration').outerHeight(),
        });

        Drupal.toolbar.models.toolbarModel = model;

        // Attach a listener to the configured media query breakpoints.
        // Executes it before Drupal.toolbar.views to avoid extra rendering.
        Object.keys(options.breakpoints).forEach((label) => {
          const mq = options.breakpoints[label];
          const mql = window.matchMedia(mq);
          Drupal.toolbar.mql[label] = mql;
          // Curry the model and the label of the media query breakpoint to
          // the mediaQueryChangeHandler function.
          mql.addListener(
            Drupal.toolbar.mediaQueryChangeHandler.bind(null, model, label),
          );
          // Fire the mediaQueryChangeHandler for each configured breakpoint
          // so that they process once.
          Drupal.toolbar.mediaQueryChangeHandler.call(null, model, label, mql);
        });

        Drupal.toolbar.views.toolbarVisualView =
          new Drupal.toolbar.ToolbarVisualView({
            el: toolbar,
            model,
            strings: options.strings,
          });
        Drupal.toolbar.views.toolbarAuralView =
          new Drupal.toolbar.ToolbarAuralView({
            el: toolbar,
            model,
            strings: options.strings,
          });
        Drupal.toolbar.views.bodyVisualView = new Drupal.toolbar.BodyVisualView(
          {
            el: toolbar,
            model,
          },
        );

        // Force layout render to fix mobile view. Only needed on load, not
        // for every media query match.
        model.trigger('change:isFixed', model, model.get('isFixed'));
        model.trigger('change:activeTray', model, model.get('activeTray'));

        // Render collapsible menus.
        const menuModel = new Drupal.toolbar.MenuModel();
        Drupal.toolbar.models.menuModel = menuModel;
        Drupal.toolbar.views.menuVisualView = new Drupal.toolbar.MenuVisualView(
          {
            el: $(toolbar).find('.toolbar-menu-administration').get(0),
            model: menuModel,
            strings: options.strings,
          },
        );

        // Handle the resolution of Drupal.toolbar.setSubtrees.
        // This is handled with a deferred so that the function may be invoked
        // asynchronously.
        Drupal.toolbar.setSubtrees.done((subtrees) => {
          menuModel.set('subtrees', subtrees);
          const theme = drupalSettings.ajaxPageState.theme;
          localStorage.setItem(
            `Drupal.toolbar.subtrees.${theme}`,
            JSON.stringify(subtrees),
          );
          // Indicate on the toolbarModel that subtrees are now loaded.
          model.set('areSubtreesLoaded', true);
        });

        // Trigger an initial attempt to load menu subitems. This first attempt
        // is made after the media query handlers have had an opportunity to
        // process. The toolbar starts in the vertical orientation by default,
        // unless the viewport is wide enough to accommodate a horizontal
        // orientation. Thus we give the Toolbar a chance to determine if it
        // should be set to horizontal orientation before attempting to load
        // menu subtrees.
        Drupal.toolbar.views.toolbarVisualView.loadSubtrees();

        $(document)
          // Update the model when the viewport offset changes.
          .on('drupalViewportOffsetChange.toolbar', (event, offsets) => {
            model.set('offsets', offsets);
          });

        // Broadcast model changes to other modules.
        model
          .on('change:orientation', (model, orientation) => {
            $(document).trigger('drupalToolbarOrientationChange', orientation);
          })
          .on('change:activeTab', (model, tab) => {
            $(document).trigger('drupalToolbarTabChange', tab);
          })
          .on('change:activeTray', (model, tray) => {
            $(document).trigger('drupalToolbarTrayChange', tray);
          });

        // If the toolbar's orientation is horizontal and no active tab is
        // defined then show the tray of the first toolbar tab by default (but
        // not the first 'Home' toolbar tab).
        if (
          Drupal.toolbar.models.toolbarModel.get('orientation') ===
            'horizontal' &&
          Drupal.toolbar.models.toolbarModel.get('activeTab') === null
        ) {
          Drupal.toolbar.models.toolbarModel.set({
            activeTab: $(
              '.toolbar-bar .toolbar-tab:not(.home-toolbar-tab) a',
            ).get(0),
          });
        }

        $(window).on({
          'dialog:aftercreate': (event, dialog, $element, settings) => {
            const $toolbar = $('#toolbar-bar');
            $toolbar.css('margin-top', '0');

            // When off-canvas is positioned in top, toolbar has to be moved down.
            if (settings.drupalOffCanvasPosition === 'top') {
              const height = Drupal.offCanvas
                .getContainer($element)
                .outerHeight();
              $toolbar.css('margin-top', `${height}px`);

              $element.on('dialogContentResize.off-canvas', () => {
                const newHeight = Drupal.offCanvas
                  .getContainer($element)
                  .outerHeight();
                $toolbar.css('margin-top', `${newHeight}px`);
              });
            }
          },
          'dialog:beforeclose': () => {
            $('#toolbar-bar').css('margin-top', '0');
          },
        });
      });
    },
  };

  /**
   * Toolbar methods of Backbone objects.
   *
   * @namespace
   */
  Drupal.toolbar = {
    /**
     * A hash of View instances.
     *
     * @type {object.<string, Backbone.View>}
     */
    views: {},

    /**
     * A hash of Model instances.
     *
     * @type {object.<string, Backbone.Model>}
     */
    models: {},

    /**
     * A hash of MediaQueryList objects tracked by the toolbar.
     *
     * @type {object.<string, object>}
     */
    mql: {},

    /**
     * Accepts a list of subtree menu elements.
     *
     * A deferred object that is resolved by an inlined JavaScript callback.
     *
     * @type {jQuery.Deferred}
     *
     * @see toolbar_subtrees_jsonp().
     */
    setSubtrees: new $.Deferred(),

    /**
     * Respond to configured narrow media query changes.
     *
     * @param {Drupal.toolbar.ToolbarModel} model
     *   A toolbar model
     * @param {string} label
     *   Media query label.
     * @param {object} mql
     *   A MediaQueryList object.
     */
    mediaQueryChangeHandler(model, label, mql) {
      switch (label) {
        case 'toolbar.narrow':
          model.set({
            isOriented: mql.matches,
            isTrayToggleVisible: false,
          });
          // If the toolbar doesn't have an explicit orientation yet, or if the
          // narrow media query doesn't match then set the orientation to
          // vertical.
          if (!mql.matches || !model.get('orientation')) {
            model.set({ orientation: 'vertical' }, { validate: true });
          }
          break;

        case 'toolbar.standard':
          model.set({
            isFixed: mql.matches,
          });
          break;

        case 'toolbar.wide':
          model.set(
            {
              orientation:
                mql.matches && !model.get('locked') ? 'horizontal' : 'vertical',
            },
            { validate: true },
          );
          // The tray orientation toggle visibility does not need to be
          // validated.
          model.set({
            isTrayToggleVisible: mql.matches,
          });
          break;

        default:
          break;
      }
    },
  };

  /**
   * A toggle is an interactive element often bound to a click handler.
   *
   * @return {string}
   *   A string representing a DOM fragment.
   */
  Drupal.theme.toolbarOrientationToggle = function () {
    return (
      '<div class="toolbar-toggle-orientation"><div class="toolbar-lining">' +
      '<button class="toolbar-icon" type="button"></button>' +
      '</div></div>'
    );
  };

  /**
   * Ajax command to set the toolbar subtrees.
   *
   * @param {Drupal.Ajax} ajax
   *   {@link Drupal.Ajax} object created by {@link Drupal.ajax}.
   * @param {object} response
   *   JSON response from the Ajax request.
   * @param {number} [status]
   *   XMLHttpRequest status.
   */
  Drupal.AjaxCommands.prototype.setToolbarSubtrees = function (
    ajax,
    response,
    status,
  ) {
    Drupal.toolbar.setSubtrees.resolve(response.subtrees);
  };
})(jQuery, Drupal, drupalSettings);
;
/**
 * @file
 * A Backbone Model for collapsible menus.
 */

(function (Backbone, Drupal) {
  /**
   * Backbone Model for collapsible menus.
   *
   * @constructor
   *
   * @augments Backbone.Model
   */
  Drupal.toolbar.MenuModel = Backbone.Model.extend(
    /** @lends Drupal.toolbar.MenuModel# */ {
      /**
       * @type {object}
       *
       * @prop {object} subtrees
       */
      defaults: /** @lends Drupal.toolbar.MenuModel# */ {
        /**
         * @type {object}
         */
        subtrees: {},
      },
    },
  );
})(Backbone, Drupal);
;
/**
 * @file
 * A Backbone Model for the toolbar.
 */

(function (Backbone, Drupal) {
  /**
   * Backbone model for the toolbar.
   *
   * @constructor
   *
   * @augments Backbone.Model
   */
  Drupal.toolbar.ToolbarModel = Backbone.Model.extend(
    /** @lends Drupal.toolbar.ToolbarModel# */ {
      /**
       * @type {object}
       *
       * @prop activeTab
       * @prop activeTray
       * @prop isOriented
       * @prop isFixed
       * @prop areSubtreesLoaded
       * @prop isViewportOverflowConstrained
       * @prop orientation
       * @prop locked
       * @prop isTrayToggleVisible
       * @prop height
       * @prop offsets
       */
      defaults: /** @lends Drupal.toolbar.ToolbarModel# */ {
        /**
         * The active toolbar tab. All other tabs should be inactive under
         * normal circumstances. It will remain active across page loads. The
         * active item is stored as an ID selector e.g. '#toolbar-item--1'.
         *
         * @type {string}
         */
        activeTab: null,

        /**
         * Represents whether a tray is open or not. Stored as an ID selector e.g.
         * '#toolbar-item--1-tray'.
         *
         * @type {string}
         */
        activeTray: null,

        /**
         * Indicates whether the toolbar is displayed in an oriented fashion,
         * either horizontal or vertical.
         *
         * @type {boolean}
         */
        isOriented: false,

        /**
         * Indicates whether the toolbar is positioned absolute (false) or fixed
         * (true).
         *
         * @type {boolean}
         */
        isFixed: false,

        /**
         * Menu subtrees are loaded through an AJAX request only when the Toolbar
         * is set to a vertical orientation.
         *
         * @type {boolean}
         */
        areSubtreesLoaded: false,

        /**
         * If the viewport overflow becomes constrained, isFixed must be true so
         * that elements in the trays aren't lost off-screen and impossible to
         * get to.
         *
         * @type {boolean}
         */
        isViewportOverflowConstrained: false,

        /**
         * The orientation of the active tray.
         *
         * @type {string}
         */
        orientation: 'horizontal',

        /**
         * A tray is locked if a user toggled it to vertical. Otherwise a tray
         * will switch between vertical and horizontal orientation based on the
         * configured breakpoints. The locked state will be maintained across page
         * loads.
         *
         * @type {boolean}
         */
        locked: false,

        /**
         * Indicates whether the tray orientation toggle is visible.
         *
         * @type {boolean}
         */
        isTrayToggleVisible: true,

        /**
         * The height of the toolbar.
         *
         * @type {number}
         */
        height: null,

        /**
         * The current viewport offsets determined by {@link Drupal.displace}. The
         * offsets suggest how a module might position is components relative to
         * the viewport.
         *
         * @type {object}
         *
         * @prop {number} top
         * @prop {number} right
         * @prop {number} bottom
         * @prop {number} left
         */
        offsets: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 0,
        },
      },

      /**
       * {@inheritdoc}
       *
       * @param {object} attributes
       *   Attributes for the toolbar.
       * @param {object} options
       *   Options for the toolbar.
       *
       * @return {string|undefined}
       *   Returns an error message if validation failed.
       */
      validate(attributes, options) {
        // Prevent the orientation being set to horizontal if it is locked, unless
        // override has not been passed as an option.
        if (
          attributes.orientation === 'horizontal' &&
          this.get('locked') &&
          !options.override
        ) {
          return Drupal.t(
            'The toolbar cannot be set to a horizontal orientation when it is locked.',
          );
        }
      },
    },
  );
})(Backbone, Drupal);
;
/**
 * @file
 * A Backbone view for the body element.
 */

(function ($, Drupal, Backbone) {
  Drupal.toolbar.BodyVisualView = Backbone.View.extend(
    /** @lends Drupal.toolbar.BodyVisualView# */ {
      /**
       * Adjusts the body element with the toolbar position and dimension changes.
       *
       * @constructs
       *
       * @augments Backbone.View
       */
      initialize() {
        this.listenTo(this.model, 'change:activeTray ', this.render);
        this.listenTo(
          this.model,
          'change:isFixed change:isViewportOverflowConstrained',
          this.isToolbarFixed,
        );
      },

      isToolbarFixed() {
        // When the toolbar is fixed, it will not scroll with page scrolling.
        const isViewportOverflowConstrained = this.model.get(
          'isViewportOverflowConstrained',
        );
        $('body').toggleClass(
          'toolbar-fixed',
          isViewportOverflowConstrained || this.model.get('isFixed'),
        );
      },

      /**
       * {@inheritdoc}
       */
      render() {
        $('body')
          // Toggle the toolbar-tray-open class on the body element. The class is
          // applied when a toolbar tray is active. Padding might be applied to
          // the body element to prevent the tray from overlapping content.
          .toggleClass('toolbar-tray-open', !!this.model.get('activeTray'));
      },
    },
  );
})(jQuery, Drupal, Backbone);
;
/**
 * @file
 * A Backbone view for the collapsible menus.
 */

(function ($, Backbone, Drupal) {
  Drupal.toolbar.MenuVisualView = Backbone.View.extend(
    /** @lends Drupal.toolbar.MenuVisualView# */ {
      /**
       * Backbone View for collapsible menus.
       *
       * @constructs
       *
       * @augments Backbone.View
       */
      initialize() {
        this.listenTo(this.model, 'change:subtrees', this.render);
      },

      /**
       * {@inheritdoc}
       */
      render() {
        const subtrees = this.model.get('subtrees');
        // Add subtrees.
        Object.keys(subtrees || {}).forEach((id) => {
          $(
            once('toolbar-subtrees', this.$el.find(`#toolbar-link-${id}`)),
          ).after(subtrees[id]);
        });
        // Render the main menu as a nested, collapsible accordion.
        if ('drupalToolbarMenu' in $.fn) {
          this.$el.children('.toolbar-menu').drupalToolbarMenu();
        }
      },
    },
  );
})(jQuery, Backbone, Drupal);
;
/**
 * @file
 * A Backbone view for the aural feedback of the toolbar.
 */

(function (Backbone, Drupal) {
  Drupal.toolbar.ToolbarAuralView = Backbone.View.extend(
    /** @lends Drupal.toolbar.ToolbarAuralView# */ {
      /**
       * Backbone view for the aural feedback of the toolbar.
       *
       * @constructs
       *
       * @augments Backbone.View
       *
       * @param {object} options
       *   Options for the view.
       * @param {object} options.strings
       *   Various strings to use in the view.
       */
      initialize(options) {
        this.strings = options.strings;

        this.listenTo(
          this.model,
          'change:orientation',
          this.onOrientationChange,
        );
        this.listenTo(this.model, 'change:activeTray', this.onActiveTrayChange);
      },

      /**
       * Announces an orientation change.
       *
       * @param {Drupal.toolbar.ToolbarModel} model
       *   The toolbar model in question.
       * @param {string} orientation
       *   The new value of the orientation attribute in the model.
       */
      onOrientationChange(model, orientation) {
        Drupal.announce(
          Drupal.t('Tray orientation changed to @orientation.', {
            '@orientation': orientation,
          }),
        );
      },

      /**
       * Announces a changed active tray.
       *
       * @param {Drupal.toolbar.ToolbarModel} model
       *   The toolbar model in question.
       * @param {HTMLElement} tray
       *   The new value of the tray attribute in the model.
       */
      onActiveTrayChange(model, tray) {
        const relevantTray =
          tray === null ? model.previous('activeTray') : tray;
        // Current activeTray and previous activeTray are empty, no state change
        // to announce.
        if (!relevantTray) {
          return;
        }
        const action = tray === null ? Drupal.t('closed') : Drupal.t('opened');
        const trayNameElement =
          relevantTray.querySelector('.toolbar-tray-name');
        let text;
        if (trayNameElement !== null) {
          text = Drupal.t('Tray "@tray" @action.', {
            '@tray': trayNameElement.textContent,
            '@action': action,
          });
        } else {
          text = Drupal.t('Tray @action.', { '@action': action });
        }
        Drupal.announce(text);
      },
    },
  );
})(Backbone, Drupal);
;
/**
 * @file
 * A Backbone view for the toolbar element. Listens to mouse & touch.
 */

(function ($, Drupal, drupalSettings, Backbone) {
  Drupal.toolbar.ToolbarVisualView = Backbone.View.extend(
    /** @lends Drupal.toolbar.ToolbarVisualView# */ {
      /**
       * Event map for the `ToolbarVisualView`.
       *
       * @return {object}
       *   A map of events.
       */
      events() {
        // Prevents delay and simulated mouse events.
        const touchEndToClick = function (event) {
          event.preventDefault();
          event.target.click();
        };

        return {
          'click .toolbar-bar .toolbar-tab .trigger': 'onTabClick',
          'click .toolbar-toggle-orientation button':
            'onOrientationToggleClick',
          'touchend .toolbar-bar .toolbar-tab .trigger': touchEndToClick,
          'touchend .toolbar-toggle-orientation button': touchEndToClick,
        };
      },

      /**
       * Backbone view for the toolbar element. Listens to mouse & touch.
       *
       * @constructs
       *
       * @augments Backbone.View
       *
       * @param {object} options
       *   Options for the view object.
       * @param {object} options.strings
       *   Various strings to use in the view.
       */
      initialize(options) {
        this.strings = options.strings;

        this.listenTo(
          this.model,
          'change:activeTab change:orientation change:isOriented change:isTrayToggleVisible',
          this.render,
        );
        this.listenTo(this.model, 'change:mqMatches', this.onMediaQueryChange);
        this.listenTo(this.model, 'change:offsets', this.adjustPlacement);
        this.listenTo(
          this.model,
          'change:activeTab change:orientation change:isOriented',
          this.updateToolbarHeight,
        );

        // Add the tray orientation toggles, but only if there is a menu.
        this.$el
          .find('.toolbar-tray .toolbar-lining')
          .has('.toolbar-menu')
          .append(Drupal.theme('toolbarOrientationToggle'));

        // Trigger an activeTab change so that listening scripts can respond on
        // page load. This will call render.
        this.model.trigger('change:activeTab');
      },

      /**
       * Update the toolbar element height.
       *
       * @constructs
       *
       * @augments Backbone.View
       */
      updateToolbarHeight() {
        const toolbarTabOuterHeight =
          $('#toolbar-bar').find('.toolbar-tab').outerHeight() || 0;
        const toolbarTrayHorizontalOuterHeight =
          $('.is-active.toolbar-tray-horizontal').outerHeight() || 0;
        this.model.set(
          'height',
          toolbarTabOuterHeight + toolbarTrayHorizontalOuterHeight,
        );

        $('body').css({
          'padding-top': this.model.get('height'),
        });
        $('html').css({
          'scroll-padding-top': this.model.get('height'),
        });

        this.triggerDisplace();
      },

      // Trigger a recalculation of viewport displacing elements. Use setTimeout
      // to ensure this recalculation happens after changes to visual elements
      // have processed.
      triggerDisplace() {
        _.defer(() => {
          Drupal.displace(true);
        });
      },

      /**
       * {@inheritdoc}
       *
       * @return {Drupal.toolbar.ToolbarVisualView}
       *   The `ToolbarVisualView` instance.
       */
      render() {
        this.updateTabs();
        this.updateTrayOrientation();
        this.updateBarAttributes();

        $('body').removeClass('toolbar-loading');

        // Load the subtrees if the orientation of the toolbar is changed to
        // vertical. This condition responds to the case that the toolbar switches
        // from horizontal to vertical orientation. The toolbar starts in a
        // vertical orientation by default and then switches to horizontal during
        // initialization if the media query conditions are met. Simply checking
        // that the orientation is vertical here would result in the subtrees
        // always being loaded, even when the toolbar initialization ultimately
        // results in a horizontal orientation.
        //
        // @see Drupal.behaviors.toolbar.attach() where admin menu subtrees
        // loading is invoked during initialization after media query conditions
        // have been processed.
        if (
          this.model.changed.orientation === 'vertical' ||
          this.model.changed.activeTab
        ) {
          this.loadSubtrees();
        }

        return this;
      },

      /**
       * Responds to a toolbar tab click.
       *
       * @param {jQuery.Event} event
       *   The event triggered.
       */
      onTabClick(event) {
        // If this tab has a tray associated with it, it is considered an
        // activatable tab.
        if (event.currentTarget.hasAttribute('data-toolbar-tray')) {
          const activeTab = this.model.get('activeTab');
          const clickedTab = event.currentTarget;

          // Set the event target as the active item if it is not already.
          this.model.set(
            'activeTab',
            !activeTab || clickedTab !== activeTab ? clickedTab : null,
          );

          event.preventDefault();
          event.stopPropagation();
        }
      },

      /**
       * Toggles the orientation of a toolbar tray.
       *
       * @param {jQuery.Event} event
       *   The event triggered.
       */
      onOrientationToggleClick(event) {
        const orientation = this.model.get('orientation');
        // Determine the toggle-to orientation.
        const antiOrientation =
          orientation === 'vertical' ? 'horizontal' : 'vertical';
        const locked = antiOrientation === 'vertical';
        // Remember the locked state.
        if (locked) {
          localStorage.setItem('Drupal.toolbar.trayVerticalLocked', 'true');
        } else {
          localStorage.removeItem('Drupal.toolbar.trayVerticalLocked');
        }
        // Update the model.
        this.model.set(
          {
            locked,
            orientation: antiOrientation,
          },
          {
            validate: true,
            override: true,
          },
        );

        event.preventDefault();
        event.stopPropagation();
      },

      /**
       * Updates the display of the tabs: toggles a tab and the associated tray.
       */
      updateTabs() {
        const $tab = $(this.model.get('activeTab'));
        // Deactivate the previous tab.
        $(this.model.previous('activeTab'))
          .removeClass('is-active')
          .prop('aria-pressed', false);
        // Deactivate the previous tray.
        $(this.model.previous('activeTray')).removeClass('is-active');

        // Activate the selected tab.
        if ($tab.length > 0) {
          $tab
            .addClass('is-active')
            // Mark the tab as pressed.
            .prop('aria-pressed', true);
          const name = $tab.attr('data-toolbar-tray');
          // Store the active tab name or remove the setting.
          const id = $tab.get(0).id;
          if (id) {
            localStorage.setItem(
              'Drupal.toolbar.activeTabID',
              JSON.stringify(id),
            );
          }
          // Activate the associated tray.
          const $tray = this.$el.find(
            `[data-toolbar-tray="${name}"].toolbar-tray`,
          );
          if ($tray.length) {
            $tray.addClass('is-active');
            this.model.set('activeTray', $tray.get(0));
          } else {
            // There is no active tray.
            this.model.set('activeTray', null);
          }
        } else {
          // There is no active tray.
          this.model.set('activeTray', null);
          localStorage.removeItem('Drupal.toolbar.activeTabID');
        }
      },

      /**
       * Update the attributes of the toolbar bar element.
       */
      updateBarAttributes() {
        const isOriented = this.model.get('isOriented');
        if (isOriented) {
          this.$el.find('.toolbar-bar').attr('data-offset-top', '');
        } else {
          this.$el.find('.toolbar-bar').removeAttr('data-offset-top');
        }
        // Toggle between a basic vertical view and a more sophisticated
        // horizontal and vertical display of the toolbar bar and trays.
        this.$el.toggleClass('toolbar-oriented', isOriented);
      },

      /**
       * Updates the orientation of the active tray if necessary.
       */
      updateTrayOrientation() {
        const orientation = this.model.get('orientation');

        // The antiOrientation is used to render the view of action buttons like
        // the tray orientation toggle.
        const antiOrientation =
          orientation === 'vertical' ? 'horizontal' : 'vertical';

        // Toggle toolbar's parent classes before other toolbar classes to avoid
        // potential flicker and re-rendering.
        $('body')
          .toggleClass('toolbar-vertical', orientation === 'vertical')
          .toggleClass('toolbar-horizontal', orientation === 'horizontal');

        const removeClass =
          antiOrientation === 'horizontal'
            ? 'toolbar-tray-horizontal'
            : 'toolbar-tray-vertical';
        const $trays = this.$el
          .find('.toolbar-tray')
          .removeClass(removeClass)
          .addClass(`toolbar-tray-${orientation}`);

        // Update the tray orientation toggle button.
        const iconClass = `toolbar-icon-toggle-${orientation}`;
        const iconAntiClass = `toolbar-icon-toggle-${antiOrientation}`;
        const $orientationToggle = this.$el
          .find('.toolbar-toggle-orientation')
          .toggle(this.model.get('isTrayToggleVisible'));
        const $orientationToggleButton = $orientationToggle.find('button');
        $orientationToggleButton[0].value = antiOrientation;
        $orientationToggleButton
          .attr('title', this.strings[antiOrientation])
          .removeClass(iconClass)
          .addClass(iconAntiClass);
        $orientationToggleButton[0].textContent = this.strings[antiOrientation];

        // Update data offset attributes for the trays.
        const dir = document.documentElement.dir;
        const edge = dir === 'rtl' ? 'right' : 'left';
        // Remove data-offset attributes from the trays so they can be refreshed.
        $trays.removeAttr('data-offset-left data-offset-right data-offset-top');
        // If an active vertical tray exists, mark it as an offset element.
        $trays
          .filter('.toolbar-tray-vertical.is-active')
          .attr(`data-offset-${edge}`, '');
        // If an active horizontal tray exists, mark it as an offset element.
        $trays
          .filter('.toolbar-tray-horizontal.is-active')
          .attr('data-offset-top', '');
      },

      /**
       * Sets the tops of the trays so that they align with the bottom of the bar.
       */
      adjustPlacement() {
        const $trays = this.$el.find('.toolbar-tray');
        if (!this.model.get('isOriented')) {
          $trays
            .removeClass('toolbar-tray-horizontal')
            .addClass('toolbar-tray-vertical');
        }
      },

      /**
       * Calls the endpoint URI that builds an AJAX command with the rendered
       * subtrees.
       *
       * The rendered admin menu subtrees HTML is cached on the client in
       * localStorage until the cache of the admin menu subtrees on the server-
       * side is invalidated. The subtreesHash is stored in localStorage as well
       * and compared to the subtreesHash in drupalSettings to determine when the
       * admin menu subtrees cache has been invalidated.
       */
      loadSubtrees() {
        const $activeTab = $(this.model.get('activeTab'));
        const orientation = this.model.get('orientation');
        // Only load and render the admin menu subtrees if:
        //   (1) They have not been loaded yet.
        //   (2) The active tab is the administration menu tab, indicated by the
        //       presence of the data-drupal-subtrees attribute.
        //   (3) The orientation of the tray is vertical.
        if (
          !this.model.get('areSubtreesLoaded') &&
          typeof $activeTab.data('drupal-subtrees') !== 'undefined' &&
          orientation === 'vertical'
        ) {
          const subtreesHash = drupalSettings.toolbar.subtreesHash;
          const theme = drupalSettings.ajaxPageState.theme;
          const endpoint = Drupal.url(`toolbar/subtrees/${subtreesHash}`);
          const cachedSubtreesHash = localStorage.getItem(
            `Drupal.toolbar.subtreesHash.${theme}`,
          );
          const cachedSubtrees = JSON.parse(
            localStorage.getItem(`Drupal.toolbar.subtrees.${theme}`),
          );
          const isVertical = this.model.get('orientation') === 'vertical';
          // If we have the subtrees in localStorage and the subtree hash has not
          // changed, then use the cached data.
          if (
            isVertical &&
            subtreesHash === cachedSubtreesHash &&
            cachedSubtrees
          ) {
            Drupal.toolbar.setSubtrees.resolve(cachedSubtrees);
          }
          // Only make the call to get the subtrees if the orientation of the
          // toolbar is vertical.
          else if (isVertical) {
            // Remove the cached menu information.
            localStorage.removeItem(`Drupal.toolbar.subtreesHash.${theme}`);
            localStorage.removeItem(`Drupal.toolbar.subtrees.${theme}`);
            // The AJAX response's command will trigger the resolve method of the
            // Drupal.toolbar.setSubtrees Promise.
            Drupal.ajax({ url: endpoint }).execute();
            // Cache the hash for the subtrees locally.
            localStorage.setItem(
              `Drupal.toolbar.subtreesHash.${theme}`,
              subtreesHash,
            );
          }
        }
      },
    },
  );
})(jQuery, Drupal, drupalSettings, Backbone);
;
(function ($, Drupal) {
  Drupal.behaviors.adminToolbar = {
    attach: function (context, settings) {

      $('a.toolbar-icon', context).removeAttr('title');

      // Make the toolbar menu navigable with keyboard.
      $('ul.toolbar-menu li.menu-item--expanded a', context).on('focusin', function () {
        $('li.menu-item--expanded', context).removeClass('hover-intent');
        $(this).parents('li.menu-item--expanded').addClass('hover-intent');
      });

      $('ul.toolbar-menu li.menu-item a', context).keydown(function (e) {
        if ((e.shiftKey && (e.keyCode || e.which) == 9)) {
          if ($(this).parent('.menu-item').prev().hasClass('menu-item--expanded')) {
            $(this).parent('.menu-item').prev().addClass('hover-intent');
          }
        }
      });

      $('.toolbar-menu:first-child > .menu-item:not(.menu-item--expanded) a, .toolbar-tab > a', context).on('focusin', function () {
        $('.menu-item--expanded').removeClass('hover-intent');
      });

      $('.toolbar-menu:first-child > .menu-item', context).on('hover', function () {
        $(this, 'a').css("background: #fff;");
      });

      $('ul:not(.toolbar-menu)', context).on({
        mousemove: function () {
          $('li.menu-item--expanded').removeClass('hover-intent');
        },
        hover: function () {
          $('li.menu-item--expanded').removeClass('hover-intent');
        }
      });

      // Always hide the dropdown menu on mobile.
      if (window.matchMedia("(max-width: 767px)").matches && $('body').hasClass('toolbar-tray-open')) {
        $('body').removeClass('toolbar-tray-open');
        $('#toolbar-item-administration').removeClass('is-active');
        $('#toolbar-item-administration-tray').removeClass('is-active');
      };

    }
  };
})(jQuery, Drupal);
;
;/*!
 * hoverIntent v1.8.1 // 2014.08.11 // jQuery v1.9.1+
 * http://briancherne.github.io/jquery-hoverIntent/
 *
 * You may use hoverIntent under the terms of the MIT license. Basically that
 * means you are free to use hoverIntent as long as this header is left intact.
 * Copyright 2007, 2014 Brian Cherne
 */

/* hoverIntent is similar to jQuery's built-in "hover" method except that
 * instead of firing the handlerIn function immediately, hoverIntent checks
 * to see if the user's mouse has slowed down (beneath the sensitivity
 * threshold) before firing the event. The handlerOut function is only
 * called after a matching handlerIn.
 *
 * // basic usage ... just like .hover()
 * .hoverIntent( handlerIn, handlerOut )
 * .hoverIntent( handlerInOut )
 *
 * // basic usage ... with event delegation!
 * .hoverIntent( handlerIn, handlerOut, selector )
 * .hoverIntent( handlerInOut, selector )
 *
 * // using a basic configuration object
 * .hoverIntent( config )
 *
 * @param  handlerIn   function OR configuration object
 * @param  handlerOut  function OR selector for delegation OR undefined
 * @param  selector    selector OR undefined
 * @author Brian Cherne <brian(at)cherne(dot)net>
 */(function (factory) {
  'use strict';
  if (typeof define === 'function' && define.amd) {
    define(['jquery'], factory);
  } else if (jQuery && !jQuery.fn.hoverIntent) {
    factory(jQuery);
  }
})(function ($) {
  'use strict';

  // default configuration values
  var _cfg = {
    interval: 100,
    sensitivity: 6,
    timeout: 0
  };

  // counter used to generate an ID for each instance
  var INSTANCE_COUNT = 0;

  // current X and Y position of mouse, updated during mousemove tracking (shared across instances)
  var cX, cY;

  // saves the current pointer position coordinates based on the given mousemove event
  var track = function (ev) {
    cX = ev.pageX;
    cY = ev.pageY;
  };

  // compares current and previous mouse positions
  var compare = function (ev,$el,s,cfg) {
    // compare mouse positions to see if pointer has slowed enough to trigger `over` function
    if ( Math.sqrt( (s.pX - cX) * (s.pX - cX) + (s.pY - cY) * (s.pY - cY) ) < cfg.sensitivity ) {
      $el.off(s.event,track);
      delete s.timeoutId;
      // set hoverIntent state as active for this element (permits `out` handler to trigger)
      s.isActive = true;
      // overwrite old mouseenter event coordinates with most recent pointer position
      ev.pageX = cX; ev.pageY = cY;
      // clear coordinate data from state object
      delete s.pX; delete s.pY;
      return cfg.over.apply($el[0],[ev]);
    } else {
      // set previous coordinates for next comparison
      s.pX = cX; s.pY = cY;
      // use self-calling timeout, guarantees intervals are spaced out properly (avoids JavaScript timer bugs)
      s.timeoutId = setTimeout( function () {compare(ev, $el, s, cfg);} , cfg.interval );
    }
  };

  // triggers given `out` function at configured `timeout` after a mouseleave and clears state
  var delay = function (ev,$el,s,out) {
    delete $el.data('hoverIntent')[s.id];
    return out.apply($el[0],[ev]);
  };

  $.fn.hoverIntent = function (handlerIn,handlerOut,selector) {
    // instance ID, used as a key to store and retrieve state information on an element
    var instanceId = INSTANCE_COUNT++;

    // extend the default configuration and parse parameters
    var cfg = $.extend({}, _cfg);
    if ( $.isPlainObject(handlerIn) ) {
      cfg = $.extend(cfg, handlerIn);
      if ( !$.isFunction(cfg.out) ) {
        cfg.out = cfg.over;
      }
    } else if ( $.isFunction(handlerOut) ) {
      cfg = $.extend(cfg, { over: handlerIn, out: handlerOut, selector: selector } );
    } else {
      cfg = $.extend(cfg, { over: handlerIn, out: handlerIn, selector: handlerOut } );
    }

    // A private function for handling mouse 'hovering'
    var handleHover = function (e) {
      // cloned event to pass to handlers (copy required for event object to be passed in IE)
      var ev = $.extend({},e);

      // the current target of the mouse event, wrapped in a jQuery object
      var $el = $(this);

      // read hoverIntent data from element (or initialize if not present)
      var hoverIntentData = $el.data('hoverIntent');
      if (!hoverIntentData) { $el.data('hoverIntent', (hoverIntentData = {})); }

      // read per-instance state from element (or initialize if not present)
      var state = hoverIntentData[instanceId];
      if (!state) { hoverIntentData[instanceId] = state = { id: instanceId }; }

      // state properties:
      // id = instance ID, used to clean up data
      // timeoutId = timeout ID, reused for tracking mouse position and delaying "out" handler
      // isActive = plugin state, true after `over` is called just until `out` is called
      // pX, pY = previously-measured pointer coordinates, updated at each polling interval
      // event = string representing the namespaced event used for mouse tracking

      // clear any existing timeout
      if (state.timeoutId) { state.timeoutId = clearTimeout(state.timeoutId); }

      // namespaced event used to register and unregister mousemove tracking
      var mousemove = state.event = 'mousemove.hoverIntent.hoverIntent' + instanceId;

      // handle the event, based on its type
      if (e.type === 'mouseenter') {
        // do nothing if already active
        if (state.isActive) { return; }
        // set "previous" X and Y position based on initial entry point
        state.pX = ev.pageX; state.pY = ev.pageY;
        // update "current" X and Y position based on mousemove
        $el.off(mousemove,track).on(mousemove,track);
        // start polling interval (self-calling timeout) to compare mouse coordinates over time
        state.timeoutId = setTimeout( function () {compare(ev,$el,state,cfg);} , cfg.interval );
      } else { // "mouseleave"
        // do nothing if not already active
        if (!state.isActive) { return; }
        // unbind expensive mousemove event
        $el.off(mousemove,track);
        // if hoverIntent state is true, then call the mouseOut function after the specified delay
        state.timeoutId = setTimeout( function () {delay(ev,$el,state,cfg.out);} , cfg.timeout );
      }
    };

    // listen for mouseenter and mouseleave
    return this.on({'mouseenter.hoverIntent':handleHover,'mouseleave.hoverIntent':handleHover}, cfg.selector);
  };
});
;
(function ($) {
  $(document).ready(function () {
    $('.toolbar-tray-horizontal li.menu-item--expanded, .toolbar-tray-horizontal ul li.menu-item--expanded .menu-item').hoverIntent({
      over: function () {
        // At the current depth, we should delete all "hover-intent" classes.
        // Other wise we get unwanted behaviour where menu items are expanded while already in hovering other ones.
        $(this).parent().find('li').removeClass('hover-intent');
        $(this).addClass('hover-intent');
      },
      out: function () {
        $(this).removeClass('hover-intent');
      },
      timeout: 250
    });
  });
})(jQuery);
;
/**
 * @file
 * Replaces the home link in toolbar with a back to site link.
 */

(function ($, Drupal, drupalSettings) {
  const pathInfo = drupalSettings.path;
  const escapeAdminPath = sessionStorage.getItem('escapeAdminPath');
  const windowLocation = window.location;

  // Saves the last non-administrative page in the browser to be able to link
  // back to it when browsing administrative pages. If there is a destination
  // parameter there is not need to save the current path because the page is
  // loaded within an existing "workflow".
  if (
    !pathInfo.currentPathIsAdmin &&
    !/destination=/.test(windowLocation.search)
  ) {
    sessionStorage.setItem('escapeAdminPath', windowLocation);
  }

  /**
   * Replaces the "Home" link with "Back to site" link.
   *
   * Back to site link points to the last non-administrative page the user
   * visited within the same browser tab.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches the replacement functionality to the toolbar-escape-admin element.
   */
  Drupal.behaviors.escapeAdmin = {
    attach() {
      const toolbarEscape = once('escapeAdmin', '[data-toolbar-escape-admin]');
      if (toolbarEscape.length && pathInfo.currentPathIsAdmin) {
        if (escapeAdminPath !== null) {
          $(toolbarEscape).attr('href', escapeAdminPath);
        } else {
          toolbarEscape[0].textContent = Drupal.t('Home');
        }
      }
    },
  };
})(jQuery, Drupal, drupalSettings);
;
/*! skrollr 0.6.30 (2015-08-12) | Alexander Prinzhorn - https://github.com/Prinzhorn/skrollr | Free to use under terms of MIT license */
!function(a,b,c){"use strict";function d(c){if(e=b.documentElement,f=b.body,T(),ha=this,c=c||{},ma=c.constants||{},c.easing)for(var d in c.easing)W[d]=c.easing[d];ta=c.edgeStrategy||"set",ka={beforerender:c.beforerender,render:c.render,keyframe:c.keyframe},la=c.forceHeight!==!1,la&&(Ka=c.scale||1),na=c.mobileDeceleration||y,pa=c.smoothScrolling!==!1,qa=c.smoothScrollingDuration||A,ra={targetTop:ha.getScrollTop()},Sa=(c.mobileCheck||function(){return/Android|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent||navigator.vendor||a.opera)})(),Sa?(ja=b.getElementById(c.skrollrBody||z),ja&&ga(),X(),Ea(e,[s,v],[t])):Ea(e,[s,u],[t]),ha.refresh(),wa(a,"resize orientationchange",function(){var a=e.clientWidth,b=e.clientHeight;(b!==Pa||a!==Oa)&&(Pa=b,Oa=a,Qa=!0)});var g=U();return function h(){$(),va=g(h)}(),ha}var e,f,g={get:function(){return ha},init:function(a){return ha||new d(a)},VERSION:"0.6.30"},h=Object.prototype.hasOwnProperty,i=a.Math,j=a.getComputedStyle,k="touchstart",l="touchmove",m="touchcancel",n="touchend",o="skrollable",p=o+"-before",q=o+"-between",r=o+"-after",s="skrollr",t="no-"+s,u=s+"-desktop",v=s+"-mobile",w="linear",x=1e3,y=.004,z="skrollr-body",A=200,B="start",C="end",D="center",E="bottom",F="___skrollable_id",G=/^(?:input|textarea|button|select)$/i,H=/^\s+|\s+$/g,I=/^data(?:-(_\w+))?(?:-?(-?\d*\.?\d+p?))?(?:-?(start|end|top|center|bottom))?(?:-?(top|center|bottom))?$/,J=/\s*(@?[\w\-\[\]]+)\s*:\s*(.+?)\s*(?:;|$)/gi,K=/^(@?[a-z\-]+)\[(\w+)\]$/,L=/-([a-z0-9_])/g,M=function(a,b){return b.toUpperCase()},N=/[\-+]?[\d]*\.?[\d]+/g,O=/\{\?\}/g,P=/rgba?\(\s*-?\d+\s*,\s*-?\d+\s*,\s*-?\d+/g,Q=/[a-z\-]+-gradient/g,R="",S="",T=function(){var a=/^(?:O|Moz|webkit|ms)|(?:-(?:o|moz|webkit|ms)-)/;if(j){var b=j(f,null);for(var c in b)if(R=c.match(a)||+c==c&&b[c].match(a))break;if(!R)return void(R=S="");R=R[0],"-"===R.slice(0,1)?(S=R,R={"-webkit-":"webkit","-moz-":"Moz","-ms-":"ms","-o-":"O"}[R]):S="-"+R.toLowerCase()+"-"}},U=function(){var b=a.requestAnimationFrame||a[R.toLowerCase()+"RequestAnimationFrame"],c=Ha();return(Sa||!b)&&(b=function(b){var d=Ha()-c,e=i.max(0,1e3/60-d);return a.setTimeout(function(){c=Ha(),b()},e)}),b},V=function(){var b=a.cancelAnimationFrame||a[R.toLowerCase()+"CancelAnimationFrame"];return(Sa||!b)&&(b=function(b){return a.clearTimeout(b)}),b},W={begin:function(){return 0},end:function(){return 1},linear:function(a){return a},quadratic:function(a){return a*a},cubic:function(a){return a*a*a},swing:function(a){return-i.cos(a*i.PI)/2+.5},sqrt:function(a){return i.sqrt(a)},outCubic:function(a){return i.pow(a-1,3)+1},bounce:function(a){var b;if(.5083>=a)b=3;else if(.8489>=a)b=9;else if(.96208>=a)b=27;else{if(!(.99981>=a))return 1;b=91}return 1-i.abs(3*i.cos(a*b*1.028)/b)}};d.prototype.refresh=function(a){var d,e,f=!1;for(a===c?(f=!0,ia=[],Ra=0,a=b.getElementsByTagName("*")):a.length===c&&(a=[a]),d=0,e=a.length;e>d;d++){var g=a[d],h=g,i=[],j=pa,k=ta,l=!1;if(f&&F in g&&delete g[F],g.attributes){for(var m=0,n=g.attributes.length;n>m;m++){var p=g.attributes[m];if("data-anchor-target"!==p.name)if("data-smooth-scrolling"!==p.name)if("data-edge-strategy"!==p.name)if("data-emit-events"!==p.name){var q=p.name.match(I);if(null!==q){var r={props:p.value,element:g,eventType:p.name.replace(L,M)};i.push(r);var s=q[1];s&&(r.constant=s.substr(1));var t=q[2];/p$/.test(t)?(r.isPercentage=!0,r.offset=(0|t.slice(0,-1))/100):r.offset=0|t;var u=q[3],v=q[4]||u;u&&u!==B&&u!==C?(r.mode="relative",r.anchors=[u,v]):(r.mode="absolute",u===C?r.isEnd=!0:r.isPercentage||(r.offset=r.offset*Ka))}}else l=!0;else k=p.value;else j="off"!==p.value;else if(h=b.querySelector(p.value),null===h)throw'Unable to find anchor target "'+p.value+'"'}if(i.length){var w,x,y;!f&&F in g?(y=g[F],w=ia[y].styleAttr,x=ia[y].classAttr):(y=g[F]=Ra++,w=g.style.cssText,x=Da(g)),ia[y]={element:g,styleAttr:w,classAttr:x,anchorTarget:h,keyFrames:i,smoothScrolling:j,edgeStrategy:k,emitEvents:l,lastFrameIndex:-1},Ea(g,[o],[])}}}for(Aa(),d=0,e=a.length;e>d;d++){var z=ia[a[d][F]];z!==c&&(_(z),ba(z))}return ha},d.prototype.relativeToAbsolute=function(a,b,c){var d=e.clientHeight,f=a.getBoundingClientRect(),g=f.top,h=f.bottom-f.top;return b===E?g-=d:b===D&&(g-=d/2),c===E?g+=h:c===D&&(g+=h/2),g+=ha.getScrollTop(),g+.5|0},d.prototype.animateTo=function(a,b){b=b||{};var d=Ha(),e=ha.getScrollTop(),f=b.duration===c?x:b.duration;return oa={startTop:e,topDiff:a-e,targetTop:a,duration:f,startTime:d,endTime:d+f,easing:W[b.easing||w],done:b.done},oa.topDiff||(oa.done&&oa.done.call(ha,!1),oa=c),ha},d.prototype.stopAnimateTo=function(){oa&&oa.done&&oa.done.call(ha,!0),oa=c},d.prototype.isAnimatingTo=function(){return!!oa},d.prototype.isMobile=function(){return Sa},d.prototype.setScrollTop=function(b,c){return sa=c===!0,Sa?Ta=i.min(i.max(b,0),Ja):a.scrollTo(0,b),ha},d.prototype.getScrollTop=function(){return Sa?Ta:a.pageYOffset||e.scrollTop||f.scrollTop||0},d.prototype.getMaxScrollTop=function(){return Ja},d.prototype.on=function(a,b){return ka[a]=b,ha},d.prototype.off=function(a){return delete ka[a],ha},d.prototype.destroy=function(){var a=V();a(va),ya(),Ea(e,[t],[s,u,v]);for(var b=0,d=ia.length;d>b;b++)fa(ia[b].element);e.style.overflow=f.style.overflow="",e.style.height=f.style.height="",ja&&g.setStyle(ja,"transform","none"),ha=c,ja=c,ka=c,la=c,Ja=0,Ka=1,ma=c,na=c,La="down",Ma=-1,Oa=0,Pa=0,Qa=!1,oa=c,pa=c,qa=c,ra=c,sa=c,Ra=0,ta=c,Sa=!1,Ta=0,ua=c};var X=function(){var d,g,h,j,o,p,q,r,s,t,u,v;wa(e,[k,l,m,n].join(" "),function(a){var e=a.changedTouches[0];for(j=a.target;3===j.nodeType;)j=j.parentNode;switch(o=e.clientY,p=e.clientX,t=a.timeStamp,G.test(j.tagName)||a.preventDefault(),a.type){case k:d&&d.blur(),ha.stopAnimateTo(),d=j,g=q=o,h=p,s=t;break;case l:G.test(j.tagName)&&b.activeElement!==j&&a.preventDefault(),r=o-q,v=t-u,ha.setScrollTop(Ta-r,!0),q=o,u=t;break;default:case m:case n:var f=g-o,w=h-p,x=w*w+f*f;if(49>x){if(!G.test(d.tagName)){d.focus();var y=b.createEvent("MouseEvents");y.initMouseEvent("click",!0,!0,a.view,1,e.screenX,e.screenY,e.clientX,e.clientY,a.ctrlKey,a.altKey,a.shiftKey,a.metaKey,0,null),d.dispatchEvent(y)}return}d=c;var z=r/v;z=i.max(i.min(z,3),-3);var A=i.abs(z/na),B=z*A+.5*na*A*A,C=ha.getScrollTop()-B,D=0;C>Ja?(D=(Ja-C)/B,C=Ja):0>C&&(D=-C/B,C=0),A*=1-D,ha.animateTo(C+.5|0,{easing:"outCubic",duration:A})}}),a.scrollTo(0,0),e.style.overflow=f.style.overflow="hidden"},Y=function(){var a,b,c,d,f,g,h,j,k,l,m,n=e.clientHeight,o=Ba();for(j=0,k=ia.length;k>j;j++)for(a=ia[j],b=a.element,c=a.anchorTarget,d=a.keyFrames,f=0,g=d.length;g>f;f++)h=d[f],l=h.offset,m=o[h.constant]||0,h.frame=l,h.isPercentage&&(l*=n,h.frame=l),"relative"===h.mode&&(fa(b),h.frame=ha.relativeToAbsolute(c,h.anchors[0],h.anchors[1])-l,fa(b,!0)),h.frame+=m,la&&!h.isEnd&&h.frame>Ja&&(Ja=h.frame);for(Ja=i.max(Ja,Ca()),j=0,k=ia.length;k>j;j++){for(a=ia[j],d=a.keyFrames,f=0,g=d.length;g>f;f++)h=d[f],m=o[h.constant]||0,h.isEnd&&(h.frame=Ja-h.offset+m);a.keyFrames.sort(Ia)}},Z=function(a,b){for(var c=0,d=ia.length;d>c;c++){var e,f,i=ia[c],j=i.element,k=i.smoothScrolling?a:b,l=i.keyFrames,m=l.length,n=l[0],s=l[l.length-1],t=k<n.frame,u=k>s.frame,v=t?n:s,w=i.emitEvents,x=i.lastFrameIndex;if(t||u){if(t&&-1===i.edge||u&&1===i.edge)continue;switch(t?(Ea(j,[p],[r,q]),w&&x>-1&&(za(j,n.eventType,La),i.lastFrameIndex=-1)):(Ea(j,[r],[p,q]),w&&m>x&&(za(j,s.eventType,La),i.lastFrameIndex=m)),i.edge=t?-1:1,i.edgeStrategy){case"reset":fa(j);continue;case"ease":k=v.frame;break;default:case"set":var y=v.props;for(e in y)h.call(y,e)&&(f=ea(y[e].value),0===e.indexOf("@")?j.setAttribute(e.substr(1),f):g.setStyle(j,e,f));continue}}else 0!==i.edge&&(Ea(j,[o,q],[p,r]),i.edge=0);for(var z=0;m-1>z;z++)if(k>=l[z].frame&&k<=l[z+1].frame){var A=l[z],B=l[z+1];for(e in A.props)if(h.call(A.props,e)){var C=(k-A.frame)/(B.frame-A.frame);C=A.props[e].easing(C),f=da(A.props[e].value,B.props[e].value,C),f=ea(f),0===e.indexOf("@")?j.setAttribute(e.substr(1),f):g.setStyle(j,e,f)}w&&x!==z&&("down"===La?za(j,A.eventType,La):za(j,B.eventType,La),i.lastFrameIndex=z);break}}},$=function(){Qa&&(Qa=!1,Aa());var a,b,d=ha.getScrollTop(),e=Ha();if(oa)e>=oa.endTime?(d=oa.targetTop,a=oa.done,oa=c):(b=oa.easing((e-oa.startTime)/oa.duration),d=oa.startTop+b*oa.topDiff|0),ha.setScrollTop(d,!0);else if(!sa){var f=ra.targetTop-d;f&&(ra={startTop:Ma,topDiff:d-Ma,targetTop:d,startTime:Na,endTime:Na+qa}),e<=ra.endTime&&(b=W.sqrt((e-ra.startTime)/qa),d=ra.startTop+b*ra.topDiff|0)}if(sa||Ma!==d){La=d>Ma?"down":Ma>d?"up":La,sa=!1;var h={curTop:d,lastTop:Ma,maxTop:Ja,direction:La},i=ka.beforerender&&ka.beforerender.call(ha,h);i!==!1&&(Z(d,ha.getScrollTop()),Sa&&ja&&g.setStyle(ja,"transform","translate(0, "+-Ta+"px) "+ua),Ma=d,ka.render&&ka.render.call(ha,h)),a&&a.call(ha,!1)}Na=e},_=function(a){for(var b=0,c=a.keyFrames.length;c>b;b++){for(var d,e,f,g,h=a.keyFrames[b],i={};null!==(g=J.exec(h.props));)f=g[1],e=g[2],d=f.match(K),null!==d?(f=d[1],d=d[2]):d=w,e=e.indexOf("!")?aa(e):[e.slice(1)],i[f]={value:e,easing:W[d]};h.props=i}},aa=function(a){var b=[];return P.lastIndex=0,a=a.replace(P,function(a){return a.replace(N,function(a){return a/255*100+"%"})}),S&&(Q.lastIndex=0,a=a.replace(Q,function(a){return S+a})),a=a.replace(N,function(a){return b.push(+a),"{?}"}),b.unshift(a),b},ba=function(a){var b,c,d={};for(b=0,c=a.keyFrames.length;c>b;b++)ca(a.keyFrames[b],d);for(d={},b=a.keyFrames.length-1;b>=0;b--)ca(a.keyFrames[b],d)},ca=function(a,b){var c;for(c in b)h.call(a.props,c)||(a.props[c]=b[c]);for(c in a.props)b[c]=a.props[c]},da=function(a,b,c){var d,e=a.length;if(e!==b.length)throw"Can't interpolate between \""+a[0]+'" and "'+b[0]+'"';var f=[a[0]];for(d=1;e>d;d++)f[d]=a[d]+(b[d]-a[d])*c;return f},ea=function(a){var b=1;return O.lastIndex=0,a[0].replace(O,function(){return a[b++]})},fa=function(a,b){a=[].concat(a);for(var c,d,e=0,f=a.length;f>e;e++)d=a[e],c=ia[d[F]],c&&(b?(d.style.cssText=c.dirtyStyleAttr,Ea(d,c.dirtyClassAttr)):(c.dirtyStyleAttr=d.style.cssText,c.dirtyClassAttr=Da(d),d.style.cssText=c.styleAttr,Ea(d,c.classAttr)))},ga=function(){ua="translateZ(0)",g.setStyle(ja,"transform",ua);var a=j(ja),b=a.getPropertyValue("transform"),c=a.getPropertyValue(S+"transform"),d=b&&"none"!==b||c&&"none"!==c;d||(ua="")};g.setStyle=function(a,b,c){var d=a.style;if(b=b.replace(L,M).replace("-",""),"zIndex"===b)isNaN(c)?d[b]=c:d[b]=""+(0|c);else if("float"===b)d.styleFloat=d.cssFloat=c;else try{R&&(d[R+b.slice(0,1).toUpperCase()+b.slice(1)]=c),d[b]=c}catch(e){}};var ha,ia,ja,ka,la,ma,na,oa,pa,qa,ra,sa,ta,ua,va,wa=g.addEvent=function(b,c,d){var e=function(b){return b=b||a.event,b.target||(b.target=b.srcElement),b.preventDefault||(b.preventDefault=function(){b.returnValue=!1,b.defaultPrevented=!0}),d.call(this,b)};c=c.split(" ");for(var f,g=0,h=c.length;h>g;g++)f=c[g],b.addEventListener?b.addEventListener(f,d,!1):b.attachEvent("on"+f,e),Ua.push({element:b,name:f,listener:d})},xa=g.removeEvent=function(a,b,c){b=b.split(" ");for(var d=0,e=b.length;e>d;d++)a.removeEventListener?a.removeEventListener(b[d],c,!1):a.detachEvent("on"+b[d],c)},ya=function(){for(var a,b=0,c=Ua.length;c>b;b++)a=Ua[b],xa(a.element,a.name,a.listener);Ua=[]},za=function(a,b,c){ka.keyframe&&ka.keyframe.call(ha,a,b,c)},Aa=function(){var a=ha.getScrollTop();Ja=0,la&&!Sa&&(f.style.height=""),Y(),la&&!Sa&&(f.style.height=Ja+e.clientHeight+"px"),Sa?ha.setScrollTop(i.min(ha.getScrollTop(),Ja)):ha.setScrollTop(a,!0),sa=!0},Ba=function(){var a,b,c=e.clientHeight,d={};for(a in ma)b=ma[a],"function"==typeof b?b=b.call(ha):/p$/.test(b)&&(b=b.slice(0,-1)/100*c),d[a]=b;return d},Ca=function(){var a,b=0;return ja&&(b=i.max(ja.offsetHeight,ja.scrollHeight)),a=i.max(b,f.scrollHeight,f.offsetHeight,e.scrollHeight,e.offsetHeight,e.clientHeight),a-e.clientHeight},Da=function(b){var c="className";return a.SVGElement&&b instanceof a.SVGElement&&(b=b[c],c="baseVal"),b[c]},Ea=function(b,d,e){var f="className";if(a.SVGElement&&b instanceof a.SVGElement&&(b=b[f],f="baseVal"),e===c)return void(b[f]=d);for(var g=b[f],h=0,i=e.length;i>h;h++)g=Ga(g).replace(Ga(e[h])," ");g=Fa(g);for(var j=0,k=d.length;k>j;j++)-1===Ga(g).indexOf(Ga(d[j]))&&(g+=" "+d[j]);b[f]=Fa(g)},Fa=function(a){return a.replace(H,"")},Ga=function(a){return" "+a+" "},Ha=Date.now||function(){return+new Date},Ia=function(a,b){return a.frame-b.frame},Ja=0,Ka=1,La="down",Ma=-1,Na=Ha(),Oa=0,Pa=0,Qa=!1,Ra=0,Sa=!1,Ta=0,Ua=[];"function"==typeof define&&define.amd?define([],function(){return g}):"undefined"!=typeof module&&module.exports?module.exports=g:a.skrollr=g}(window,document);;
(function ($) {
   $.fn.gav_skrollr = function(s) {
      var $w = $(window), 
          loaded, 
          skrollr = this
          th = 200;
       this.one("gav_skrollr", function() {
         s.refresh();
      });
      function gav_skrollr() {
         var inview = skrollr.filter(function() {
           var $e = $(this);
           var wt = $w.scrollTop(),
               wb = wt + $w.height(),
               et = $e.offset().top,
               eb = et + $e.height();

           return eb >= wt - th && et <= wb + th;
         });
         loaded = inview.trigger("gav_skrollr");
         skrollr = skrollr.not(loaded);
      }
      $(window).on("scroll.gav_skrollr", gav_skrollr);
   };
   $(window).on('load', function(){
      setTimeout(function() {
         s = skrollr.init({forceHeight:!1,smoothScrolling:!1,mobileCheck:function(){return!1}});
         if($('.skrollable.refresh').length){
            $('.skrollable.refresh').gav_skrollr(s);
         }
      }, 50);
   });
})(jQuery);
;
/**
 *
 * Color picker
 * Author: Stefan Petre www.eyecon.ro
 * 
 * Dual licensed under the MIT and GPL licenses
 * 
 */
(function ($) {
	var ColorPicker = function () {
		var
			ids = {},
			inAction,
			charMin = 65,
			visible,
			tpl = '<div class="colorpicker"><div class="colorpicker_color"><div><div></div></div></div><div class="colorpicker_hue"><div></div></div><div class="colorpicker_new_color"></div><div class="colorpicker_current_color"></div><div class="colorpicker_hex"><input type="text" maxlength="6" size="6" /></div><div class="colorpicker_rgb_r colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_submit"></div></div>',
			defaults = {
				eventName: 'click',
				onShow: function () {},
				onBeforeShow: function(){},
				onHide: function () {},
				onChange: function () {},
				onSubmit: function () {},
				color: 'ff0000',
				livePreview: true,
				flat: false
			},
			fillRGBFields = function  (hsb, cal) {
				var rgb = HSBToRGB(hsb);
				$(cal).data('colorpicker').fields
					.eq(1).val(rgb.r).end()
					.eq(2).val(rgb.g).end()
					.eq(3).val(rgb.b).end();
			},
			fillHSBFields = function  (hsb, cal) {
				$(cal).data('colorpicker').fields
					.eq(4).val(hsb.h).end()
					.eq(5).val(hsb.s).end()
					.eq(6).val(hsb.b).end();
			},
			fillHexFields = function (hsb, cal) {
				$(cal).data('colorpicker').fields
					.eq(0).val(HSBToHex(hsb)).end();
			},
			setSelector = function (hsb, cal) {
				$(cal).data('colorpicker').selector.css('backgroundColor', '#' + HSBToHex({h: hsb.h, s: 100, b: 100}));
				$(cal).data('colorpicker').selectorIndic.css({
					left: parseInt(150 * hsb.s/100, 10),
					top: parseInt(150 * (100-hsb.b)/100, 10)
				});
			},
			setHue = function (hsb, cal) {
				$(cal).data('colorpicker').hue.css('top', parseInt(150 - 150 * hsb.h/360, 10));
			},
			setCurrentColor = function (hsb, cal) {
				$(cal).data('colorpicker').currentColor.css('backgroundColor', '#' + HSBToHex(hsb));
			},
			setNewColor = function (hsb, cal) {
				$(cal).data('colorpicker').newColor.css('backgroundColor', '#' + HSBToHex(hsb));
			},
			keyDown = function (ev) {
				var pressedKey = ev.charCode || ev.keyCode || -1;
				if ((pressedKey > charMin && pressedKey <= 90) || pressedKey == 32) {
					return false;
				}
				var cal = $(this).parent().parent();
				if (cal.data('colorpicker').livePreview === true) {
					change.apply(this);
				}
			},
			change = function (ev) {
				var cal = $(this).parent().parent(), col;
				if (this.parentNode.className.indexOf('_hex') > 0) {
					cal.data('colorpicker').color = col = HexToHSB(fixHex(this.value));
				} else if (this.parentNode.className.indexOf('_hsb') > 0) {
					cal.data('colorpicker').color = col = fixHSB({
						h: parseInt(cal.data('colorpicker').fields.eq(4).val(), 10),
						s: parseInt(cal.data('colorpicker').fields.eq(5).val(), 10),
						b: parseInt(cal.data('colorpicker').fields.eq(6).val(), 10)
					});
				} else {
					cal.data('colorpicker').color = col = RGBToHSB(fixRGB({
						r: parseInt(cal.data('colorpicker').fields.eq(1).val(), 10),
						g: parseInt(cal.data('colorpicker').fields.eq(2).val(), 10),
						b: parseInt(cal.data('colorpicker').fields.eq(3).val(), 10)
					}));
				}
				if (ev) {
					fillRGBFields(col, cal.get(0));
					fillHexFields(col, cal.get(0));
					fillHSBFields(col, cal.get(0));
				}
				setSelector(col, cal.get(0));
				setHue(col, cal.get(0));
				setNewColor(col, cal.get(0));
				cal.data('colorpicker').onChange.apply(cal, [col, HSBToHex(col), HSBToRGB(col)]);
			},
			blur = function (ev) {
				var cal = $(this).parent().parent();
				cal.data('colorpicker').fields.parent().removeClass('colorpicker_focus');
			},
			focus = function () {
				charMin = this.parentNode.className.indexOf('_hex') > 0 ? 70 : 65;
				$(this).parent().parent().data('colorpicker').fields.parent().removeClass('colorpicker_focus');
				$(this).parent().addClass('colorpicker_focus');
			},
			downIncrement = function (ev) {
				var field = $(this).parent().find('input').focus();
				var current = {
					el: $(this).parent().addClass('colorpicker_slider'),
					max: this.parentNode.className.indexOf('_hsb_h') > 0 ? 360 : (this.parentNode.className.indexOf('_hsb') > 0 ? 100 : 255),
					y: ev.pageY,
					field: field,
					val: parseInt(field.val(), 10),
					preview: $(this).parent().parent().data('colorpicker').livePreview					
				};
				$(document).bind('mouseup', current, upIncrement);
				$(document).bind('mousemove', current, moveIncrement);
			},
			moveIncrement = function (ev) {
				ev.data.field.val(Math.max(0, Math.min(ev.data.max, parseInt(ev.data.val + ev.pageY - ev.data.y, 10))));
				if (ev.data.preview) {
					change.apply(ev.data.field.get(0), [true]);
				}
				return false;
			},
			upIncrement = function (ev) {
				change.apply(ev.data.field.get(0), [true]);
				ev.data.el.removeClass('colorpicker_slider').find('input').focus();
				$(document).unbind('mouseup', upIncrement);
				$(document).unbind('mousemove', moveIncrement);
				return false;
			},
			downHue = function (ev) {
				var current = {
					cal: $(this).parent(),
					y: $(this).offset().top
				};
				current.preview = current.cal.data('colorpicker').livePreview;
				$(document).bind('mouseup', current, upHue);
				$(document).bind('mousemove', current, moveHue);
			},
			moveHue = function (ev) {
				change.apply(
					ev.data.cal.data('colorpicker')
						.fields
						.eq(4)
						.val(parseInt(360*(150 - Math.max(0,Math.min(150,(ev.pageY - ev.data.y))))/150, 10))
						.get(0),
					[ev.data.preview]
				);
				return false;
			},
			upHue = function (ev) {
				fillRGBFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
				fillHexFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
				$(document).unbind('mouseup', upHue);
				$(document).unbind('mousemove', moveHue);
				return false;
			},
			downSelector = function (ev) {
				var current = {
					cal: $(this).parent(),
					pos: $(this).offset()
				};
				current.preview = current.cal.data('colorpicker').livePreview;
				$(document).bind('mouseup', current, upSelector);
				$(document).bind('mousemove', current, moveSelector);
			},
			moveSelector = function (ev) {
				change.apply(
					ev.data.cal.data('colorpicker')
						.fields
						.eq(6)
						.val(parseInt(100*(150 - Math.max(0,Math.min(150,(ev.pageY - ev.data.pos.top))))/150, 10))
						.end()
						.eq(5)
						.val(parseInt(100*(Math.max(0,Math.min(150,(ev.pageX - ev.data.pos.left))))/150, 10))
						.get(0),
					[ev.data.preview]
				);
				return false;
			},
			upSelector = function (ev) {
				fillRGBFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
				fillHexFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
				$(document).unbind('mouseup', upSelector);
				$(document).unbind('mousemove', moveSelector);
				return false;
			},
			enterSubmit = function (ev) {
				$(this).addClass('colorpicker_focus');
			},
			leaveSubmit = function (ev) {
				$(this).removeClass('colorpicker_focus');
			},
			clickSubmit = function (ev) {
				var cal = $(this).parent();
				var col = cal.data('colorpicker').color;
				cal.data('colorpicker').origColor = col;
				setCurrentColor(col, cal.get(0));
				cal.data('colorpicker').onSubmit(col, HSBToHex(col), HSBToRGB(col), cal.data('colorpicker').el);
			},
			show = function (ev) {
				var cal = $('#' + $(this).data('colorpickerId'));
				cal.data('colorpicker').onBeforeShow.apply(this, [cal.get(0)]);
				var pos = $(this).offset();
				var viewPort = getViewport();
				var top = pos.top + this.offsetHeight;
				var left = pos.left;
				if (top + 176 > viewPort.t + viewPort.h) {
					top -= this.offsetHeight + 176;
				}
				if (left + 356 > viewPort.l + viewPort.w) {
					left -= 356;
				}
				cal.css({left: left + 'px', top: top + 'px'});
				if (cal.data('colorpicker').onShow.apply(this, [cal.get(0)]) != false) {
					cal.show();
				}
				$(document).bind('mousedown', {cal: cal}, hide);
				return false;
			},
			hide = function (ev) {
				if (!isChildOf(ev.data.cal.get(0), ev.target, ev.data.cal.get(0))) {
					if (ev.data.cal.data('colorpicker').onHide.apply(this, [ev.data.cal.get(0)]) != false) {
						ev.data.cal.hide();
					}
					$(document).unbind('mousedown', hide);
				}
			},
			isChildOf = function(parentEl, el, container) {
				if (parentEl == el) {
					return true;
				}
				if (parentEl.contains) {
					return parentEl.contains(el);
				}
				if ( parentEl.compareDocumentPosition ) {
					return !!(parentEl.compareDocumentPosition(el) & 16);
				}
				var prEl = el.parentNode;
				while(prEl && prEl != container) {
					if (prEl == parentEl)
						return true;
					prEl = prEl.parentNode;
				}
				return false;
			},
			getViewport = function () {
				var m = document.compatMode == 'CSS1Compat';
				return {
					l : window.pageXOffset || (m ? document.documentElement.scrollLeft : document.body.scrollLeft),
					t : window.pageYOffset || (m ? document.documentElement.scrollTop : document.body.scrollTop),
					w : window.innerWidth || (m ? document.documentElement.clientWidth : document.body.clientWidth),
					h : window.innerHeight || (m ? document.documentElement.clientHeight : document.body.clientHeight)
				};
			},
			fixHSB = function (hsb) {
				return {
					h: Math.min(360, Math.max(0, hsb.h)),
					s: Math.min(100, Math.max(0, hsb.s)),
					b: Math.min(100, Math.max(0, hsb.b))
				};
			}, 
			fixRGB = function (rgb) {
				return {
					r: Math.min(255, Math.max(0, rgb.r)),
					g: Math.min(255, Math.max(0, rgb.g)),
					b: Math.min(255, Math.max(0, rgb.b))
				};
			},
			fixHex = function (hex) {
				var len = 6 - hex.length;
				if (len > 0) {
					var o = [];
					for (var i=0; i<len; i++) {
						o.push('0');
					}
					o.push(hex);
					hex = o.join('');
				}
				return hex;
			}, 
			HexToRGB = function (hex) {
				var hex = parseInt(((hex.indexOf('#') > -1) ? hex.substring(1) : hex), 16);
				return {r: hex >> 16, g: (hex & 0x00FF00) >> 8, b: (hex & 0x0000FF)};
			},
			HexToHSB = function (hex) {
				return RGBToHSB(HexToRGB(hex));
			},
			RGBToHSB = function (rgb) {
				var hsb = {
					h: 0,
					s: 0,
					b: 0
				};
				var min = Math.min(rgb.r, rgb.g, rgb.b);
				var max = Math.max(rgb.r, rgb.g, rgb.b);
				var delta = max - min;
				hsb.b = max;
				if (max != 0) {
					
				}
				hsb.s = max != 0 ? 255 * delta / max : 0;
				if (hsb.s != 0) {
					if (rgb.r == max) {
						hsb.h = (rgb.g - rgb.b) / delta;
					} else if (rgb.g == max) {
						hsb.h = 2 + (rgb.b - rgb.r) / delta;
					} else {
						hsb.h = 4 + (rgb.r - rgb.g) / delta;
					}
				} else {
					hsb.h = -1;
				}
				hsb.h *= 60;
				if (hsb.h < 0) {
					hsb.h += 360;
				}
				hsb.s *= 100/255;
				hsb.b *= 100/255;
				return hsb;
			},
			HSBToRGB = function (hsb) {
				var rgb = {};
				var h = Math.round(hsb.h);
				var s = Math.round(hsb.s*255/100);
				var v = Math.round(hsb.b*255/100);
				if(s == 0) {
					rgb.r = rgb.g = rgb.b = v;
				} else {
					var t1 = v;
					var t2 = (255-s)*v/255;
					var t3 = (t1-t2)*(h%60)/60;
					if(h==360) h = 0;
					if(h<60) {rgb.r=t1;	rgb.b=t2; rgb.g=t2+t3}
					else if(h<120) {rgb.g=t1; rgb.b=t2;	rgb.r=t1-t3}
					else if(h<180) {rgb.g=t1; rgb.r=t2;	rgb.b=t2+t3}
					else if(h<240) {rgb.b=t1; rgb.r=t2;	rgb.g=t1-t3}
					else if(h<300) {rgb.b=t1; rgb.g=t2;	rgb.r=t2+t3}
					else if(h<360) {rgb.r=t1; rgb.g=t2;	rgb.b=t1-t3}
					else {rgb.r=0; rgb.g=0;	rgb.b=0}
				}
				return {r:Math.round(rgb.r), g:Math.round(rgb.g), b:Math.round(rgb.b)};
			},
			RGBToHex = function (rgb) {
				var hex = [
					rgb.r.toString(16),
					rgb.g.toString(16),
					rgb.b.toString(16)
				];
				$.each(hex, function (nr, val) {
					if (val.length == 1) {
						hex[nr] = '0' + val;
					}
				});
				return hex.join('');
			},
			HSBToHex = function (hsb) {
				return RGBToHex(HSBToRGB(hsb));
			},
			restoreOriginal = function () {
				var cal = $(this).parent();
				var col = cal.data('colorpicker').origColor;
				cal.data('colorpicker').color = col;
				fillRGBFields(col, cal.get(0));
				fillHexFields(col, cal.get(0));
				fillHSBFields(col, cal.get(0));
				setSelector(col, cal.get(0));
				setHue(col, cal.get(0));
				setNewColor(col, cal.get(0));
			};
		return {
			init: function (opt) {
				opt = $.extend({}, defaults, opt||{});
				if (typeof opt.color == 'string') {
					opt.color = HexToHSB(opt.color);
				} else if (opt.color.r != undefined && opt.color.g != undefined && opt.color.b != undefined) {
					opt.color = RGBToHSB(opt.color);
				} else if (opt.color.h != undefined && opt.color.s != undefined && opt.color.b != undefined) {
					opt.color = fixHSB(opt.color);
				} else {
					return this;
				}
				return this.each(function () {
					if (!$(this).data('colorpickerId')) {
						var options = $.extend({}, opt);
						options.origColor = opt.color;
						var id = 'collorpicker_' + parseInt(Math.random() * 1000);
						$(this).data('colorpickerId', id);
						var cal = $(tpl).attr('id', id);
						if (options.flat) {
							cal.appendTo(this).show();
						} else {
							cal.appendTo(document.body);
						}
						options.fields = cal
											.find('input')
												.bind('keyup', keyDown)
												.bind('change', change)
												.bind('blur', blur)
												.bind('focus', focus);
						cal
							.find('span').bind('mousedown', downIncrement).end()
							.find('>div.colorpicker_current_color').bind('click', restoreOriginal);
						options.selector = cal.find('div.colorpicker_color').bind('mousedown', downSelector);
						options.selectorIndic = options.selector.find('div div');
						options.el = this;
						options.hue = cal.find('div.colorpicker_hue div');
						cal.find('div.colorpicker_hue').bind('mousedown', downHue);
						options.newColor = cal.find('div.colorpicker_new_color');
						options.currentColor = cal.find('div.colorpicker_current_color');
						cal.data('colorpicker', options);
						cal.find('div.colorpicker_submit')
							.bind('mouseenter', enterSubmit)
							.bind('mouseleave', leaveSubmit)
							.bind('click', clickSubmit);
						fillRGBFields(options.color, cal.get(0));
						fillHSBFields(options.color, cal.get(0));
						fillHexFields(options.color, cal.get(0));
						setHue(options.color, cal.get(0));
						setSelector(options.color, cal.get(0));
						setCurrentColor(options.color, cal.get(0));
						setNewColor(options.color, cal.get(0));
						if (options.flat) {
							cal.css({
								position: 'relative',
								display: 'block'
							});
						} else {
							$(this).bind(options.eventName, show);
						}
					}
				});
			},
			showPicker: function() {
				return this.each( function () {
					if ($(this).data('colorpickerId')) {
						show.apply(this);
					}
				});
			},
			hidePicker: function() {
				return this.each( function () {
					if ($(this).data('colorpickerId')) {
						$('#' + $(this).data('colorpickerId')).hide();
					}
				});
			},
			setColor: function(col) {
				if (typeof col == 'string') {
					col = HexToHSB(col);
				} else if (col.r != undefined && col.g != undefined && col.b != undefined) {
					col = RGBToHSB(col);
				} else if (col.h != undefined && col.s != undefined && col.b != undefined) {
					col = fixHSB(col);
				} else {
					return this;
				}
				return this.each(function(){
					if ($(this).data('colorpickerId')) {
						var cal = $('#' + $(this).data('colorpickerId'));
						cal.data('colorpicker').color = col;
						cal.data('colorpicker').origColor = col;
						fillRGBFields(col, cal.get(0));
						fillHSBFields(col, cal.get(0));
						fillHexFields(col, cal.get(0));
						setHue(col, cal.get(0));
						setSelector(col, cal.get(0));
						setCurrentColor(col, cal.get(0));
						setNewColor(col, cal.get(0));
					}
				});
			}
		};
	}();
	$.fn.extend({
		ColorPicker: ColorPicker.init,
		ColorPickerHide: ColorPicker.hidePicker,
		ColorPickerShow: ColorPicker.showPicker,
		ColorPickerSetColor: ColorPicker.setColor
	});
})(jQuery);
var keyString="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
base64Encode = function(c) {
  var a = "";
  var k, h, f, j, g, e, d;
  var b = 0;
  c = UTF8Encode(c);
  while (b < c.length) {
    k = c.charCodeAt(b++);
    h = c.charCodeAt(b++);
    f = c.charCodeAt(b++);
    j = k >> 2;
    g = ((k & 3) << 4) | (h >> 4);
    e = ((h & 15) << 2) | (f >> 6);
    d = f & 63;
    if (isNaN(h)) {
      e = d = 64
    } else {
      if (isNaN(f)) {
        d = 64
      }
    }
    a = a + keyString.charAt(j)
    + keyString.charAt(g)
    + keyString.charAt(e)
    + keyString.charAt(d)
  }
  return a
};

UTF8Encode = function(b) {
  b = b.replace(/\x0d\x0a/g, "\x0a");
  var a = "";
  for ( var e = 0; e < b.length; e++) {
    var d = b.charCodeAt(e);
    if (d < 128) {
      a += String.fromCharCode(d)
    } else {
      if ((d > 127) && (d < 2048)) {
        a += String.fromCharCode((d >> 6) | 192);
        a += String.fromCharCode((d & 63) | 128)
      } else {
        a += String.fromCharCode((d >> 12) | 224);
        a += String.fromCharCode(((d >> 6) & 63) | 128);
        a += String.fromCharCode((d & 63) | 128)
      }
    }
  }
  return a;
};

var $customize;
if($customize == null) $customize = {};

(function ($) {
  $(document).ready(function () {

    // === ColorPicker ===
    if($.fn.ColorPicker){
      $('.colorselector input').each(function(){
        var $input = $(this);
        $input.attr('readonly','readonly');
        $input.ColorPicker({
          onChange:function (hsb, hex, rgb) {
            $input.parent().find('.input-group-addon').css('backgroundColor', '#' + hex);
            $input.val( '#' + hex );
          } 
       });
      });
      $('.colorselector .remove').each(function(){
        $(this).click(function(){
          $(this).parent().find('input').val('');
          $(this).parent().find('.input-group-addon').css('backgroundColor', '#eeeeee');
        })
      })
    }

    $('input#gavias_customize_save').click(function () {
      saveCustomize();
    });

    $('#gavias_customize_preview').click(function(){
      previewCustomize();
    });

    $('#gavias_customize_reset').click(function(){
      if(drupalSettings.gavias_customize.json){
        var data = drupalSettings.gavias_customize.json;
        changeProfile(data);
      }else{
        $('#gavias_customize_form .customize-option').each(function (index) {
          $(this).val('');
        });
        changeColor();
      }
    });

    if(drupalSettings.gavias_customize.json){
      
      var data = drupalSettings.gavias_customize.json;
      changeProfile(data);
      //console.log(data);
    }
  })

  function changeColor(){
    $('#gavias_customize_form .colorselector').each(function(){
      $this = $(this);
      $(this).find('.input-group-addon').each(function(){
          $(this).css('background',  $this.find('input').val());
      });
    });
  }

  function dataCustomize() {
    jQuery('#gavias_customize_form .customize-option').each(function (index) {
      $customize[jQuery(this).attr('name')] = $(this).val();
    });      
  }

  function changeProfile(data){
    var items = {};
    var items = jQuery.parseJSON(data);
    if(items){
      $('#gavias_customize_form .customize-option').each(function (index) {
        if(items[$(this).attr('name')]){
          $(this).val(items[$(this).attr('name')]);
        }else{
          $(this).val('');
        }
      }) 
      changeColor();
    }  
  }

  function saveCustomize() {
    dataCustomize();
    var datacustomize = JSON.stringify($customize);
    var data = {
      data: datacustomize,
      theme_name: $('#gva_theme_name').val(),
    };
    
    $('#gavias_customize_save').val('Saving...');
    $.ajax({
      url: drupalSettings.gavias_customize.save,
      type: 'POST',
      data: data,
      dataType: 'Json',
      success: function (data) {
        $('#gavias_customize_save').val('Save');
      },
      error: function (jqXHR, textStatus, errorThrown) {
        alert(textStatus + ":" + jqXHR.responseText);
      }
    });
  }

  function previewCustomize() {
    dataCustomize();
    var datacustomize = JSON.stringify($customize);
    var data = {
      data: datacustomize,
      theme_name: $('#gva_theme_name').val(),
    };
    
    $('#gavias_customize_preview').val('Loading...');
    $.ajax({
      url: drupalSettings.gavias_customize.preview,
      type: 'POST',
      data: data,
      dataType: 'Json',
      success: function (data) {
        $('#gavias_customize_preview').val('Preview');
        $('style.customize').html('');
        if($('head div#gavias_customize_style').length){
          $('head div#gavias_customize_style').html(data['style']);
        }else{
          $('head').append('<div id="gavias_customize_style">' + data['style'] + '</div>');
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        alert(textStatus + ":" + jqXHR.responseText);
      }
    });
  }

})(jQuery);

;
/**
 * @file
 * Infinite Scroll JS.
 */

(function ($, Drupal, debounce) {
  "use strict";

  // Cached reference to $(window).
  var $window = $(window);

  // The threshold for how far to the bottom you should reach before reloading.
  var scrollThreshold = 200;

  // The selector for the automatic pager.
  var automaticPagerSelector = '[data-drupal-views-infinite-scroll-pager="automatic"]';

  // The selector for both manual load and automatic pager.
  var pagerSelector = '[data-drupal-views-infinite-scroll-pager]';

  // The selector for the automatic pager.
  var contentWrapperSelectorPortfolio = '[data-drupal-views-infinite-scroll-content-wrapper-gvaloadmore]';

  var contentWrapperSelectorListings = '[data-drupal-views-infinite-scroll-content-wrapper-gvaloadmorelistings]';

  var contentWrapperSelector = '[data-drupal-views-infinite-scroll-content-wrapper]';

  // The event and namespace that is bound to window for automatic scrolling.
  var scrollEvent = 'scroll.views_infinite_scroll';

  /**
   * Insert a views infinite scroll view into the document.
   *
   * @param {jQuery} $newView
   *   New content detached from the DOM.
   */
  $.fn.infiniteScrollInsertView = function ($newView) {
    var currentViewId = this.selector.replace('.js-view-dom-id-', 'views_dom_id:');
    // Get the existing ajaxViews object.
    var view = Drupal.views.instances[currentViewId];
    // Remove once so that the exposed form and pager are processed on
    // behavior attach.
    once.remove('ajax-pager', view.$view);
    once.remove('exposed-form', view.$exposed_form);
    // Make sure infinite scroll can be reinitialized.
    var $existingPager = view.$view.find(pagerSelector);
       once.remove('infinite-scroll', $existingPager);

    //-- Gavias Custom
    if($newView.find(contentWrapperSelectorPortfolio).length > 0){
      contentWrapperSelector = contentWrapperSelectorPortfolio;
    }

    if($newView.find(contentWrapperSelectorListings).length > 0){
      contentWrapperSelector = contentWrapperSelectorListings;
    }
    //-- End Gavias Custom

    var $newRows = $newView.find(contentWrapperSelector).children();
    var $newPager = $newView.find('.js-pager__items');

    // Add the new rows to existing view.
    
    //-- Gavias Custom
    if($newView.find(contentWrapperSelectorPortfolio).length > 0){
      view.$view.find(contentWrapperSelector).isotope('insert', $newRows);
      view.$view.find(contentWrapperSelector).imagesLoaded(function() {
        view.$view.find(contentWrapperSelector).isotope('layout');
      });
    }else if($newView.find(contentWrapperSelectorListings).length > 0){
      view.$view.find(contentWrapperSelector).append($newRows);
      var i = 0;
      $('.listing-items .listing-items-wrapper').each(function(){
        $(this).attr('data-marker', i);
        i = i + 1;
      });
      var map = L.DomUtil.get('listing-main-map');
      map.remove();
      $('.main-map-wrapper').html('<div id="listing-main-map" class="listing-main-map"></div>');
      map_init();
      
      $('.listing-block').each(function(){
        $(this).magnificPopup({
          delegate: 'a.image-popup', 
          type: 'image',
          gallery: {
            enabled: true
          },
        });
      });

      $('.popup-video').magnificPopup({
        type: 'iframe',
        fixedContentPos: false
      });

      var marker_id = 0;
      $('.listing-items').each(function(){ 
        $(this).find('.item-columns .listing-item-wrapper').each(function(){
          $(this).attr('data-marker', marker_id);
          marker_id = marker_id + 1;
        });
      });
        
      map_action();
    }else{
      view.$view.find(contentWrapperSelector).append($newRows);
      
      $('.listing-block').each(function(){
        $(this).magnificPopup({
          delegate: 'a.image-popup', 
          type: 'image',
          gallery: {
            enabled: true
          },
        });
      });

      $('.popup-video').magnificPopup({
        type: 'iframe',
        fixedContentPos: false
      });

      $('.listing-items').each(function(){ 
        $(this).find('.item-columns .listing-item-wrapper').each(function(){
          $(this).attr('data-marker', marker_id);
          marker_id = marker_id + 1;
        });
      });
      if (typeof map_action !== 'undefined' && $.isFunction(map_action)) {
        map_action();
      }
    }
    //-- End Gavias Custom

    // Replace the pager link with the new link and ajaxPageState values.
    $existingPager.replaceWith($newPager);

    // Run views and VIS behaviors.
    Drupal.attachBehaviors(view.$view[0]);
  };

  /**
   * Handle the automatic paging based on the scroll amount.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Initialize infinite scroll pagers and bind the scroll event.
   * @prop {Drupal~behaviorDetach} detach
   *   During `unload` remove the scroll event binding.
   */
  Drupal.behaviors.views_infinite_scroll_automatic = {
    attach : function (context, settings) {
      once('infinite-scroll', automaticPagerSelector, context).forEach(function (elem) {
        var $pager = $(elem);
        $pager.addClass('visually-hidden');
        var isLoadNeeded = function () {
          return window.innerHeight + window.pageYOffset > $pager.offset().top - scrollThreshold;
        };
        $window.on(scrollEvent, debounce(function () {
          if (isLoadNeeded()) {
            $pager.find('[rel=next]').click();
            $window.off(scrollEvent);
          }
        }, 200));
        if (isLoadNeeded()) {
          $window.trigger(scrollEvent);
        }
      });
    },
    detach: function (context, settings, trigger) {
      // In the case where the view is removed from the document, remove it's
      // events. This is important in the case a view being refreshed for a reason
      // other than a scroll. AJAX filters are a good example of the event needing
      // to be destroyed earlier than above.
      if (trigger === 'unload') {
        if (once.remove('infinite-scroll', automaticPagerSelector, context).length) {
          $window.off(scrollEvent);
        }
      }
    }
  };

  /**
   * Views AJAX pagination filter.
   *
   * In case the Entity View Attachment is rendered in a view context,
   * the default filter function prevents the required 'Use AJAX' setting
   * to work.
   *
   * @return {Boolean}
   *   Whether to apply the Views AJAX paginator. VIS requires this setting
   *   for pagination.
   */
  Drupal.views.ajaxView.prototype.filterNestedViews = function () {
    return this.$view.hasClass('view-eva') || !this.$view.parents('.view').length;
  };

})(jQuery, Drupal, Drupal.debounce);
;
