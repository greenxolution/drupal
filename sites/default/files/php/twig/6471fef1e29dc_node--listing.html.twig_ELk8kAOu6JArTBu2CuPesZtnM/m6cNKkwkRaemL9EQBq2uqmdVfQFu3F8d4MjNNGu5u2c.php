<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/gavias_lozin/templates/node/node--listing.html.twig */
class __TwigTemplate_fafe02da225cd5561801dcaa97895c3f extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 2
        $context["classes"] = [0 => "node", 1 => "node-detail", 2 => ("node--type-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source,         // line 5
($context["node"] ?? null), "bundle", [], "any", false, false, true, 5), 5, $this->source))), 3 => ((twig_get_attribute($this->env, $this->source,         // line 6
($context["node"] ?? null), "isPromoted", [], "method", false, false, true, 6)) ? ("node--promoted") : ("")), 4 => ((twig_get_attribute($this->env, $this->source,         // line 7
($context["node"] ?? null), "isSticky", [], "method", false, false, true, 7)) ? ("node--sticky") : ("")), 5 => (( !twig_get_attribute($this->env, $this->source,         // line 8
($context["node"] ?? null), "isPublished", [], "method", false, false, true, 8)) ? ("node--unpublished") : ("")), 6 => ((        // line 9
($context["view_mode"] ?? null)) ? (("node--view-mode-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["view_mode"] ?? null), 9, $this->source)))) : ("")), 7 => "clearfix"];
        // line 13
        ob_start(function () { return ''; });
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "body", [], "any", false, false, true, 13), 13, $this->source), "html", null, true);
        $context["conBody"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 14
        ob_start(function () { return ''; });
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_address", [], "any", false, false, true, 14), "value", [], "any", false, false, true, 14), 14, $this->source), "html", null, true);
        $context["conAddress"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 15
        ob_start(function () { return ''; });
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_video", [], "any", false, false, true, 15), "value", [], "any", false, false, true, 15), 15, $this->source), "html", null, true);
        $context["conVideo"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 16
        echo "<!-- Start Display article for teaser page -->
";
        // line 17
        if ((($context["view_mode"] ?? null) == "teaser")) {
            echo " 
  
  <div class=\"listing-block v2\">
    
    ";
            // line 21
            if ($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_image", [], "any", false, false, true, 21))) {
                // line 22
                echo "      <div class=\"listing-image text-center\">
        ";
                // line 23
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_image", [], "any", false, false, true, 23), 23, $this->source), "html", null, true);
                echo "
        <span class=\"show-in-map\"><a href=\"#\" title=\"";
                // line 24
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Show In Map"));
                echo "\"><i class=\"la la-map-marker\"></i></a></span>
        <div class=\"listing-preview\">
          ";
                // line 26
                if (twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_gallery", [], "any", false, false, true, 26)) {
                    // line 27
                    echo "            <div class=\"preview-gallery\">";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_gallery", [], "any", false, false, true, 27), 27, $this->source), "html", null, true);
                    echo "</div>
          ";
                }
                // line 28
                echo "  
          ";
                // line 29
                if ($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_video", [], "any", false, false, true, 29))) {
                    // line 30
                    echo "            <div class=\"preview-video\">
              <a class=\"popup-video\" href=\"";
                    // line 31
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, twig_trim_filter($this->sandbox->ensureToStringAllowed(($context["conVideo"] ?? null), 31, $this->source)), "html", null, true);
                    echo "\"><i class=\"icon la la-camera\"></i>";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar("Video");
                    echo "</a>
            </div>
          ";
                }
                // line 34
                echo "        </div>  
      </div>
    ";
            }
            // line 36
            echo "  

    <div class=\"listing-content clearfix\">  
      <div class=\"listing-info\">
        <h3 class=\"title\"><a href=\"";
            // line 40
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["url"] ?? null), 40, $this->source), "html", null, true);
            echo "\" rel=\"bookmark\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null), 40, $this->source), "html", null, true);
            echo "</a></h3>
        ";
            // line 41
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_address", [], "any", false, false, true, 41), "value", [], "any", false, false, true, 41)) {
                // line 42
                echo "          <div class=\"address\"><i class=\"icon la la-map\"></i>";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, twig_striptags($this->sandbox->ensureToStringAllowed(($context["conAddress"] ?? null), 42, $this->source)), "html", null, true);
                echo "</div>
        ";
            }
            // line 44
            echo "        ";
            if ($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_phone", [], "any", false, false, true, 44))) {
                // line 45
                echo "          <div class=\"phone\"><i class=\"icon la la-phone\"></i>";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_phone", [], "any", false, false, true, 45), "value", [], "any", false, false, true, 45), 45, $this->source), "html", null, true);
                echo "</div>
        ";
            }
            // line 47
            echo "      </div>
      <div class=\"listing-footer\">
        <div class=\"left listing-category\">";
            // line 49
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_category", [], "any", false, false, true, 49), 49, $this->source), "html", null, true);
            echo "</div>
        <div class=\"right listing-location\"><i class=\"icon la la-map-marker\"></i>";
            // line 50
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_location", [], "any", false, false, true, 50), 50, $this->source), "html", null, true);
            echo "</div>
      </div>
    </div>  
    <div class=\"listing-data hidden\">
      <span class=\"data-lat\">";
            // line 54
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_map", [], "any", false, false, true, 54), "lat", [], "any", false, false, true, 54), 54, $this->source), "html", null, true);
            echo "</span>
      <span class=\"data-lon\">";
            // line 55
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_map", [], "any", false, false, true, 55), "lon", [], "any", false, false, true, 55), 55, $this->source), "html", null, true);
            echo "</span>
      <span class=\"data-html\">
        <span class=\"gva-map-content-popup\">
          <span class=\"image\">
            <a href=\"";
            // line 59
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["url"] ?? null), 59, $this->source), "html", null, true);
            echo "\" rel=\"bookmark\">
              <img src=\"";
            // line 60
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\gavias_hook_themer\TwigExtension']->imageStyle($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_image", [], "any", false, false, true, 60), "entity", [], "any", false, false, true, 60), "uri", [], "any", false, false, true, 60), "value", [], "any", false, false, true, 60), 60, $this->source), "small"), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_image", [], "any", false, false, true, 60), "alt", [], "any", false, false, true, 60), 60, $this->source), "html", null, true);
            echo "\"/>
            </a>
          </span>
          <span class=\"content-inner\">
            <span class=\"title\"><a href=\"";
            // line 64
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["url"] ?? null), 64, $this->source), "html", null, true);
            echo "\" rel=\"bookmark\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "title", [], "any", false, false, true, 64), "value", [], "any", false, false, true, 64), 64, $this->source), "html", null, true);
            echo "</a></span>
            ";
            // line 65
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_address", [], "any", false, false, true, 65), "value", [], "any", false, false, true, 65)) {
                // line 66
                echo "              <span class=\"address\"><i class=\"icon la la-map\"></i>";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, twig_striptags($this->sandbox->ensureToStringAllowed(($context["conAddress"] ?? null), 66, $this->source)), "html", null, true);
                echo "</span>
            ";
            }
            // line 68
            echo "            ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_phone", [], "any", false, false, true, 68), "value", [], "any", false, false, true, 68)) {
                // line 69
                echo "              <span class=\"phone\"><i class=\"icon la la-phone\"></i>";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_phone", [], "any", false, false, true, 69), "value", [], "any", false, false, true, 69), 69, $this->source), "html", null, true);
                echo "</span>
            ";
            }
            // line 71
            echo "          </span>  
        </span>
      </span>
    </div>
  </div> 

";
        } elseif ((        // line 77
($context["view_mode"] ?? null) == "teaser_2")) {
            // line 78
            echo "  <div class=\"listing-block\">
    <div class=\"listing-image text-center\">
      ";
            // line 80
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_image", [], "any", false, false, true, 80), 80, $this->source), "html", null, true);
            echo "
      <span class=\"show-in-map\"><a href=\"#\" title=\"";
            // line 81
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Show In Map"));
            echo "\"><i class=\"la la-map-marker\"></i></a></span>
      <div class=\"listing-preview\">
        ";
            // line 83
            if (twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_gallery", [], "any", false, false, true, 83)) {
                // line 84
                echo "          <div class=\"preview-gallery\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_gallery", [], "any", false, false, true, 84), 84, $this->source), "html", null, true);
                echo "</div>
        ";
            }
            // line 85
            echo "  
        ";
            // line 86
            if ($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_video", [], "any", false, false, true, 86))) {
                // line 87
                echo "          <div class=\"preview-video\">
            <a class=\"popup-video\" href=\"";
                // line 88
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, twig_trim_filter($this->sandbox->ensureToStringAllowed(($context["conVideo"] ?? null), 88, $this->source)), "html", null, true);
                echo "\"><i class=\"icon la la-camera\"></i>";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar("Video");
                echo "</a>
          </div>
        ";
            }
            // line 91
            echo "      </div>  
    </div>
    <div class=\"listing-content clearfix\">  
      <div class=\"listing-info\">
        <h3 class=\"title\"><a href=\"";
            // line 95
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["url"] ?? null), 95, $this->source), "html", null, true);
            echo "\" rel=\"bookmark\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null), 95, $this->source), "html", null, true);
            echo "</a></h3>
        <div class=\"body\">";
            // line 96
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, twig_striptags($this->sandbox->ensureToStringAllowed(($context["conBody"] ?? null), 96, $this->source)), "html", null, true);
            echo "</div>
        ";
            // line 97
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_address", [], "any", false, false, true, 97), "value", [], "any", false, false, true, 97)) {
                // line 98
                echo "          <div class=\"address\"><i class=\"icon la la-map\"></i>";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, twig_striptags($this->sandbox->ensureToStringAllowed(($context["conAddress"] ?? null), 98, $this->source)), "html", null, true);
                echo "</div>
        ";
            }
            // line 100
            echo "        ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_phone", [], "any", false, false, true, 100), "value", [], "any", false, false, true, 100)) {
                // line 101
                echo "          <div class=\"phone\"><i class=\"icon la la-phone\"></i>";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_phone", [], "any", false, false, true, 101), "value", [], "any", false, false, true, 101), 101, $this->source), "html", null, true);
                echo "</div>
        ";
            }
            // line 103
            echo "      </div>
      <div class=\"listing-footer\">
        <div class=\"left listing-category\">";
            // line 105
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_category", [], "any", false, false, true, 105), 105, $this->source), "html", null, true);
            echo "</div>
        <div class=\"right listing-location\"><i class=\"icon la la-map-marker\"></i>";
            // line 106
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_location", [], "any", false, false, true, 106), 106, $this->source), "html", null, true);
            echo "</div>
      </div>
    </div>  
    <div class=\"listing-data hidden\">
      <span class=\"data-lat\">";
            // line 110
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_map", [], "any", false, false, true, 110), "lat", [], "any", false, false, true, 110), 110, $this->source), "html", null, true);
            echo "</span>
      <span class=\"data-lon\">";
            // line 111
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_map", [], "any", false, false, true, 111), "lon", [], "any", false, false, true, 111), 111, $this->source), "html", null, true);
            echo "</span>
      <span class=\"data-html\">
        <span class=\"gva-map-content-popup\">
          <span class=\"image\">
            <a href=\"";
            // line 115
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["url"] ?? null), 115, $this->source), "html", null, true);
            echo "\" rel=\"bookmark\">
              <img src=\"";
            // line 116
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\gavias_hook_themer\TwigExtension']->imageStyle($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_image", [], "any", false, false, true, 116), "entity", [], "any", false, false, true, 116), "uri", [], "any", false, false, true, 116), "value", [], "any", false, false, true, 116), 116, $this->source), "small"), "html", null, true);
            echo "\" alt=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_image", [], "any", false, false, true, 116), "alt", [], "any", false, false, true, 116), 116, $this->source), "html", null, true);
            echo "\"/>
            </a>
          </span>
          <span class=\"content-inner\">
            <span class=\"title\"><a href=\"";
            // line 120
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["url"] ?? null), 120, $this->source), "html", null, true);
            echo "\" rel=\"bookmark\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "title", [], "any", false, false, true, 120), "value", [], "any", false, false, true, 120), 120, $this->source), "html", null, true);
            echo "</a></span>
            ";
            // line 121
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_address", [], "any", false, false, true, 121), "value", [], "any", false, false, true, 121)) {
                // line 122
                echo "              <span class=\"address\"><i class=\"icon la la-map\"></i>";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, twig_striptags($this->sandbox->ensureToStringAllowed(($context["conAddress"] ?? null), 122, $this->source)), "html", null, true);
                echo "</span>
            ";
            }
            // line 124
            echo "            ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_phone", [], "any", false, false, true, 124), "value", [], "any", false, false, true, 124)) {
                // line 125
                echo "              <span class=\"phone\"><i class=\"icon la la-phone\"></i>";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_phone", [], "any", false, false, true, 125), "value", [], "any", false, false, true, 125), 125, $this->source), "html", null, true);
                echo "</span>
            ";
            }
            // line 127
            echo "          </span>  
        </span>
      </span>
    </div>
  </div>

";
        } else {
            // line 135
            echo "
<article";
            // line 136
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method", false, false, true, 136), "addClass", [0 => "node-listing-single"], "method", false, false, true, 136), 136, $this->source), "html", null, true);
            echo ">
  <div class=\"listing-top\">
    <div id=\"listing-home\" class=\"listing-gallery before-help-region\">
      ";
            // line 139
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_gallery", [], "any", false, false, true, 139), 139, $this->source), "html", null, true);
            echo "
    </div>
    
    <div class=\"container listing-top-content\">
      <div class=\"row\">
        <div class=\"col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12\">
          <div class=\"listing-categories\">";
            // line 145
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_category", [], "any", false, false, true, 145), 145, $this->source), "html", null, true);
            echo "</div>
          <h1";
            // line 146
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["title_attributes"] ?? null), "addClass", [0 => "post-title"], "method", false, false, true, 146), 146, $this->source), "html", null, true);
            echo ">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null), 146, $this->source), "html", null, true);
            echo "</h1>
          <div class=\"listing-price\"><span class=\"label\">";
            // line 147
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Prices"));
            echo ": </span>
          ";
            // line 148
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_price_e", [], "any", false, false, true, 148), 148, $this->source), "html", null, true);
            echo "
        <script>
          //Pedro Garcia

          const myprice = document.querySelector(\".listing-price .field.field--name-field-listing-price-e.field--type-decimal.field--label-hidden.field__item\");
          
          let value = myprice.textContent;

          let valueoutcome = new Intl.NumberFormat('de-DE', 
                                                  { style: 'currency', 
                                                  currency: 'EUR',  
                                                  minimumFractionDigits: 0,
                                                  maximumFractionDigits: 0, }).format(value)

          myprice.innerHTML = valueoutcome;

        </script>
          </div>
        </div>
      </div>    
    </div> 

    <div class=\"listing-nav sticky-listing-nav\">
      <div class=\"listing-nav-inner\">
        <div class=\"listing-nav-inner-inner\">
          <div class=\"container\">
            <div class=\"row\">
              <div class=\"col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12\">
                <ul>
                  <li><a href=\"#listing-home\">";
            // line 177
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Home"));
            echo "</a></li>
                  <li><a href=\"#listing-description\">";
            // line 178
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Description"));
            echo "</a></li>
                  <li><a href=\"#listing-features\">";
            // line 179
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Listing Features"));
            echo "</a></li>
                  <li><a href=\"#listing-location\">";
            // line 180
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Location"));
            echo "</a></li>
                  <li><a href=\"#listing-video\">";
            // line 181
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Video"));
            echo "</a></li>
                  <li><a href=\"#listing-comment\">";
            // line 182
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Comment"));
            echo "</a></li>
                </ul>
              </div>
            </div>  
          </div>
        </div>  
      </div>  
    </div>  

  </div>  

  <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12\">
        <div class=\"listing-content-main\">
          
          ";
            // line 198
            if ($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "body", [], "any", false, false, true, 198))) {
                // line 199
                echo "            <div class=\"listing-info-block listing-description\" id=\"listing-description\">
              <div class=\"title\"><i class=\"la la-file-text\"></i>";
                // line 200
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Description"));
                echo "</div>
              <div class=\"block-content\">
                ";
                // line 202
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "body", [], "any", false, false, true, 202), 202, $this->source), "html", null, true);
                echo "
              </div>
            </div>  
          ";
            }
            // line 205
            echo "  

          ";
            // line 207
            if ($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_building_amenities", [], "any", false, false, true, 207))) {
                // line 208
                echo "            <div class=\"listing-info-block listing-amenties\" id=\"listing-features\">
              <div class=\"title\"><i class=\"la la-check-circle\"></i>";
                // line 209
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Amenties"));
                echo "</div>
              <div class=\"block-content\">
                ";
                // line 211
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_building_amenities", [], "any", false, false, true, 211), 211, $this->source), "html", null, true);
                echo "
                
              </div>  
            </div> 
          ";
            }
            // line 215
            echo "  

          <div class=\"listing-info-block listing-location\" id=\"listing-location\">
            <div class=\"title\"><i class=\"la la-map-marker\"></i>";
            // line 218
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Location"));
            echo "</div>
            <div class=\"block-content\">
              <div class=\"listing-location-taxonomy\">";
            // line 220
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_location", [], "any", false, false, true, 220), 220, $this->source), "html", null, true);
            echo "</div>
              <div class=\"listing-main-map\" id=\"listing-main-map\"></div>
              <div class=\"listing-items hidden\">
                <div class=\"listing-block\">
                  <div class=\"listing-data hidden\">
                    ";
            // line 225
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_category", [], "any", false, false, true, 225), 225, $this->source), "html", null, true);
            echo "
                    <span class=\"data-lat\">";
            // line 226
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_map", [], "any", false, false, true, 226), "lat", [], "any", false, false, true, 226), 226, $this->source), "html", null, true);
            echo "</span>
                    <span class=\"data-lon\">";
            // line 227
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_map", [], "any", false, false, true, 227), "lon", [], "any", false, false, true, 227), 227, $this->source), "html", null, true);
            echo "</span>
                    <span class=\"data-html\">
                      <span class=\"gva-map-content-popup\">
                        <span class=\"image\">
                          <img src=\"";
            // line 231
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\gavias_hook_themer\TwigExtension']->imageStyle($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_image", [], "any", false, false, true, 231), "entity", [], "any", false, false, true, 231), "uri", [], "any", false, false, true, 231), "value", [], "any", false, false, true, 231), 231, $this->source), "small"), "html", null, true);
            echo "\" />
                        </span>
                        <span class=\"content-inner\">
                          <span class=\"title\"><a href=\"";
            // line 234
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["url"] ?? null), 234, $this->source), "html", null, true);
            echo "\" rel=\"bookmark\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "title", [], "any", false, false, true, 234), "value", [], "any", false, false, true, 234), 234, $this->source), "html", null, true);
            echo "</a></span>
                          ";
            // line 235
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_address", [], "any", false, false, true, 235), "value", [], "any", false, false, true, 235)) {
                // line 236
                echo "                            <span class=\"address\"><i class=\"icon la la-map\"></i>";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, twig_striptags($this->sandbox->ensureToStringAllowed(($context["conAddress"] ?? null), 236, $this->source)), "html", null, true);
                echo "</span>
                          ";
            }
            // line 238
            echo "                          ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_phone", [], "any", false, false, true, 238), "value", [], "any", false, false, true, 238)) {
                // line 239
                echo "                            <span class=\"phone\"><i class=\"icon la la-phone\"></i>";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_phone", [], "any", false, false, true, 239), "value", [], "any", false, false, true, 239), 239, $this->source), "html", null, true);
                echo "</span>
                          ";
            }
            // line 241
            echo "                        </span>  
                      </span>
                    </span>
                  </div>
                </div>  
              </div>
            </div>
          </div>

          <div class=\"listing-info-block listing-video\" id=\"listing-video\">
            <div class=\"title\"><i class=\"la la-video-camera\"></i>";
            // line 251
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Video"));
            echo "</div>
            <div class=\"block-content\">
              ";
            // line 253
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(($context["listing_video"] ?? null), 253, $this->source));
            echo "
            </div>  
          </div>

          ";
            // line 257
            if ($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "comment", [], "any", false, false, true, 257))) {
                // line 258
                echo "            <div class=\"listing-info-block listing-comment\" id=\"listing-comment\">
              <div class=\"title\">";
                // line 259
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Comment"));
                echo "</div>
              <div class=\"block-content\">
                <div id=\"node-single-comment\">
                  ";
                // line 262
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "comment", [], "any", false, false, true, 262), 262, $this->source), "html", null, true);
                echo "
                </div>
              </div>
            </div>
          ";
            }
            // line 266
            echo "  

        </div>  
      </div>
      <div class=\"col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12\">
        <div class=\"listing-content-main\">
          <div class=\"listing-info-block business-info\">
            <div class=\"title\"><i class=\"la la-map-signs\"></i>";
            // line 273
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Business Info"));
            echo "</div>
            <div class=\"block-content\">
              <ul class=\"business-info\">

                ";
            // line 277
            if (($context["conAddress"] ?? null)) {
                // line 278
                echo "                  <li><span class=\"address\"><i class=\"icon la la-map\"></i>";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, twig_striptags($this->sandbox->ensureToStringAllowed(($context["conAddress"] ?? null), 278, $this->source)), "html", null, true);
                echo "</span></li>
                ";
            }
            // line 280
            echo "
                ";
            // line 281
            if ($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_email", [], "any", false, false, true, 281))) {
                // line 282
                echo "                  <li><a href=\"mailto:";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_email", [], "any", false, false, true, 282), "value", [], "any", false, false, true, 282), 282, $this->source), "html", null, true);
                echo "\">
                    <i class=\"icon la la-envelope\"></i>";
                // line 283
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_email", [], "any", false, false, true, 283), "value", [], "any", false, false, true, 283), 283, $this->source), "html", null, true);
                echo "
                  </a></li>
                ";
            }
            // line 286
            echo "
                ";
            // line 287
            if ($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_phone", [], "any", false, false, true, 287))) {
                // line 288
                echo "                  <li><i class=\"icon la la-phone\"></i>";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_phone", [], "any", false, false, true, 288), "value", [], "any", false, false, true, 288), 288, $this->source), "html", null, true);
                echo "</li>
                ";
            }
            // line 289
            echo "  

                ";
            // line 291
            if ($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_website", [], "any", false, false, true, 291))) {
                // line 292
                echo "                  <li><span><i class=\"icon la la-globe\"></i>";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_website", [], "any", false, false, true, 292), "value", [], "any", false, false, true, 292), 292, $this->source), "html", null, true);
                echo "</span></li>
                ";
            }
            // line 293
            echo "  

              </ul>

              <ul class=\"listing-socials\">

                ";
            // line 299
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_facebook", [], "any", false, false, true, 299), "value", [], "any", false, false, true, 299)) {
                // line 300
                echo "                  <li><a href=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_facebook", [], "any", false, false, true, 300), "value", [], "any", false, false, true, 300), 300, $this->source), "html", null, true);
                echo "\"><i class=\"icon la la-facebook\"></i></a></li>
                ";
            }
            // line 302
            echo "
                ";
            // line 303
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_google", [], "any", false, false, true, 303), "value", [], "any", false, false, true, 303)) {
                // line 304
                echo "                  <li><a href=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_google", [], "any", false, false, true, 304), "value", [], "any", false, false, true, 304), 304, $this->source), "html", null, true);
                echo "\"><i class=\"icon la la-google\"></i></a></li>
                ";
            }
            // line 306
            echo "
                ";
            // line 307
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_linkedin", [], "any", false, false, true, 307), "value", [], "any", false, false, true, 307)) {
                // line 308
                echo "                  <li><a href=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_linkedin", [], "any", false, false, true, 308), "value", [], "any", false, false, true, 308), 308, $this->source), "html", null, true);
                echo "\"><i class=\"icon la la-linkedin\"></i></a></li>
                ";
            }
            // line 310
            echo "
                ";
            // line 311
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_twitter", [], "any", false, false, true, 311), "value", [], "any", false, false, true, 311)) {
                // line 312
                echo "                  <li><a href=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["node"] ?? null), "field_listing_twitter", [], "any", false, false, true, 312), "value", [], "any", false, false, true, 312), 312, $this->source), "html", null, true);
                echo "\"><i class=\"icon la la-twitter\"></i></a></li>
                ";
            }
            // line 314
            echo "
              </ul>
            </div>  
          </div>

          ";
            // line 319
            if ($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_time", [], "any", false, false, true, 319))) {
                // line 320
                echo "            <div class=\"listing-info-block business-hours\">
              <div class=\"title\"><i class=\"la la-clock-o\"></i>";
                // line 321
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Business Hours"));
                echo "</div>
              <div class=\"block-content\">
                ";
                // line 323
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_time", [], "any", false, false, true, 323), 323, $this->source), "html", null, true);
                echo "
              </div>
            </div>
          ";
            }
            // line 327
            echo "
          ";
            // line 328
            if ($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_tags", [], "any", false, false, true, 328))) {
                // line 329
                echo "            <div class=\"listing-info-block listing-tags\">
              <div class=\"title\"><i class=\"la la-tags\"></i>";
                // line 330
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Tags"));
                echo "</div>
              <div class=\"block-content\">
                ";
                // line 332
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_listing_tags", [], "any", false, false, true, 332), 332, $this->source), "html", null, true);
                echo "
              </div>
            </div>
          ";
            }
            // line 336
            echo "
          ";
            // line 337
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["listing_sidebar"] ?? null), 337, $this->source), "html", null, true);
            echo "

        </div>  

      </div>
    </div>
  </div>  
</article>
<script>
  map_init('single');
</script>

<!-- End Display article for detail page -->
";
        }
        // line 351
        echo "
";
    }

    public function getTemplateName()
    {
        return "themes/gavias_lozin/templates/node/node--listing.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  776 => 351,  759 => 337,  756 => 336,  749 => 332,  744 => 330,  741 => 329,  739 => 328,  736 => 327,  729 => 323,  724 => 321,  721 => 320,  719 => 319,  712 => 314,  706 => 312,  704 => 311,  701 => 310,  695 => 308,  693 => 307,  690 => 306,  684 => 304,  682 => 303,  679 => 302,  673 => 300,  671 => 299,  663 => 293,  657 => 292,  655 => 291,  651 => 289,  645 => 288,  643 => 287,  640 => 286,  634 => 283,  629 => 282,  627 => 281,  624 => 280,  618 => 278,  616 => 277,  609 => 273,  600 => 266,  592 => 262,  586 => 259,  583 => 258,  581 => 257,  574 => 253,  569 => 251,  557 => 241,  551 => 239,  548 => 238,  542 => 236,  540 => 235,  534 => 234,  528 => 231,  521 => 227,  517 => 226,  513 => 225,  505 => 220,  500 => 218,  495 => 215,  487 => 211,  482 => 209,  479 => 208,  477 => 207,  473 => 205,  466 => 202,  461 => 200,  458 => 199,  456 => 198,  437 => 182,  433 => 181,  429 => 180,  425 => 179,  421 => 178,  417 => 177,  385 => 148,  381 => 147,  375 => 146,  371 => 145,  362 => 139,  356 => 136,  353 => 135,  344 => 127,  338 => 125,  335 => 124,  329 => 122,  327 => 121,  321 => 120,  312 => 116,  308 => 115,  301 => 111,  297 => 110,  290 => 106,  286 => 105,  282 => 103,  276 => 101,  273 => 100,  267 => 98,  265 => 97,  261 => 96,  255 => 95,  249 => 91,  241 => 88,  238 => 87,  236 => 86,  233 => 85,  227 => 84,  225 => 83,  220 => 81,  216 => 80,  212 => 78,  210 => 77,  202 => 71,  196 => 69,  193 => 68,  187 => 66,  185 => 65,  179 => 64,  170 => 60,  166 => 59,  159 => 55,  155 => 54,  148 => 50,  144 => 49,  140 => 47,  134 => 45,  131 => 44,  125 => 42,  123 => 41,  117 => 40,  111 => 36,  106 => 34,  98 => 31,  95 => 30,  93 => 29,  90 => 28,  84 => 27,  82 => 26,  77 => 24,  73 => 23,  70 => 22,  68 => 21,  61 => 17,  58 => 16,  54 => 15,  50 => 14,  46 => 13,  44 => 9,  43 => 8,  42 => 7,  41 => 6,  40 => 5,  39 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/gavias_lozin/templates/node/node--listing.html.twig", "/var/www/html/calpemar.com/themes/gavias_lozin/templates/node/node--listing.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 2, "if" => 17);
        static $filters = array("clean_class" => 5, "escape" => 13, "render" => 21, "t" => 24, "trim" => 31, "striptags" => 42, "image_style" => 60, "raw" => 253);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['clean_class', 'escape', 'render', 't', 'trim', 'striptags', 'image_style', 'raw'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
