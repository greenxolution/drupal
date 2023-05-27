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

/* themes/gavias_lozin/templates/page/header-1.html.twig */
class __TwigTemplate_f85cc209d45df3a95f387e9f2d06dbd4 extends Template
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
        // line 1
        echo "<header id=\"header\" class=\"header-default\">

  ";
        // line 3
        $context["class_sticky"] = "";
        // line 4
        echo "  ";
        if ((($context["sticky_menu"] ?? null) == 1)) {
            // line 5
            echo "    ";
            $context["class_sticky"] = "gv-sticky-menu";
            // line 6
            echo "  ";
        }
        echo "  
  <div class=\"";
        // line 7
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["class_sticky"] ?? null), 7, $this->source), "html", null, true);
        echo "\">
   <div class=\"header-main button-header-";
        // line 8
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\gavias_hook_themer\TwigExtension']->themeSetting("hide_header_button_link"), "html", null, true);
        echo "\">
      <div class=\"header-content-layout\">
         <div class=\"header-main-inner p-relative\">
            <div class=\"row\">
              <div class=\"col-md-12 col-sm-12 col-xs-12 content-inner\">
                <div class=\"branding\">
                  ";
        // line 14
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "branding", [], "any", false, false, true, 14)) {
            // line 15
            echo "                    ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "branding", [], "any", false, false, true, 15), 15, $this->source), "html", null, true);
            echo "
                  ";
        }
        // line 16
        echo "  
                </div>
                <div class=\"header-inner clearfix\">
                  <div class=\"main-menu\">
                    <div class=\"area-main-menu\">
                      <div class=\"area-inner\">
                          <div class=\"gva-offcanvas-mobile\">
                            <div class=\"close-offcanvas hidden\"><i class=\"fa fa-times\"></i></div>
                            <div class=\"main-menu-inner\">
                              ";
        // line 25
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "main_menu", [], "any", false, false, true, 25)) {
            // line 26
            echo "                                ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "main_menu", [], "any", false, false, true, 26), 26, $this->source), "html", null, true);
            echo "
                              ";
        }
        // line 28
        echo "                            </div>

                            ";
        // line 30
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "offcanvas", [], "any", false, false, true, 30)) {
            // line 31
            echo "                              <div class=\"after-offcanvas hidden\">
                                ";
            // line 32
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "offcanvas", [], "any", false, false, true, 32), 32, $this->source), "html", null, true);
            echo "
                              </div>
                           ";
        }
        // line 35
        echo "                          </div> 
                          <div id=\"menu-bar\" class=\"menu-bar d-lg-none d-xl-none\">
                            <span class=\"one\"></span>
                            <span class=\"two\"></span>
                            <span class=\"three\"></span>
                          </div>
                        
                          ";
        // line 42
        if (($this->extensions['Drupal\gavias_hook_themer\TwigExtension']->themeSetting("hide_header_button_link") != "hide")) {
            // line 43
            echo "                            <div class=\"header-button\">
                              ";
            // line 44
            if (($context["custom_account"] ?? null)) {
                // line 45
                echo "                                <a href=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["base_url"] ?? null), 45, $this->source), "html", null, true);
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\gavias_hook_themer\TwigExtension']->themeSetting("header_button_link"), "html", null, true);
                echo " \">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("+ Add Listing"));
                echo "</a>
                              ";
            } else {
                // line 47
                echo "                                <a href=\"";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getPath("user.login"));
                echo "\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("+ Add Listing"));
                echo "</a>
                              ";
            }
            // line 49
            echo "                            </div>
                          ";
        }
        // line 50
        echo " 

                          <div class=\"gva-user-region user-region\">
                            <span class=\"icon\">
                              ";
        // line 54
        if (($context["user_picture"] ?? null)) {
            // line 55
            echo "                                <img src=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getFileUrl($this->sandbox->ensureToStringAllowed(($context["user_picture"] ?? null), 55, $this->source)), "html", null, true);
            echo "\" alt=\"\"/>
                              ";
        } else {
            // line 56
            echo "  
                                <i class=\"fa fa-user\"></i>
                              ";
        }
        // line 59
        echo "                            </span>
                            <div class=\"user-content\">  
                              ";
        // line 61
        if (($context["custom_account"] ?? null)) {
            // line 62
            echo "                                <div class=\"account-message\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(($context["custom_account"] ?? null), 62, $this->source));
            echo "</div>
                              ";
        }
        // line 63
        echo "  
                              <ul class=\"user-links\">
                                ";
        // line 65
        if (($context["custom_account"] ?? null)) {
            // line 66
            echo "                                  <li><a href=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["base_url"] ?? null), 66, $this->source), "html", null, true);
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\gavias_hook_themer\TwigExtension']->themeSetting("header_button_link"), "html", null, true);
            echo " \">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("+ Add Listing"));
            echo "</a></li>
                                  <li><a href=\"";
            // line 67
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getPath("user.page"));
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("+ My Account"));
            echo "</a></li>
                                  <li><a href=\"";
            // line 68
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getPath("user.logout"));
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("+ Logout"));
            echo "</a></li>
                                ";
        } else {
            // line 70
            echo "                                  <li><a href=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getPath("user.login"));
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("+ Login"));
            echo "</a></li>
                                  <li><a href=\"";
            // line 71
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getPath("user.register"));
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("+ Register"));
            echo "</a></li>
                                ";
        }
        // line 72
        echo "  
                              </ul>
                            </div>  
                          </div>


                          ";
        // line 78
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "search", [], "any", false, false, true, 78)) {
            // line 79
            echo "                            <div class=\"gva-search-region search-region d-none\">
                              <span class=\"icon\"><i class=\"fa fa-search\"></i></span>
                              <div class=\"search-content\">  
                                ";
            // line 82
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "search", [], "any", false, false, true, 82), 82, $this->source), "html", null, true);
            echo "
                              </div>  
                            </div>
                          ";
        }
        // line 86
        echo "
                      </div>
                    </div>
                  </div>  
                </div> 
              </div>

            </div>
         </div>
      </div>
   </div>
  </div>
</header>
";
    }

    public function getTemplateName()
    {
        return "themes/gavias_lozin/templates/page/header-1.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  242 => 86,  235 => 82,  230 => 79,  228 => 78,  220 => 72,  213 => 71,  206 => 70,  199 => 68,  193 => 67,  185 => 66,  183 => 65,  179 => 63,  173 => 62,  171 => 61,  167 => 59,  162 => 56,  156 => 55,  154 => 54,  148 => 50,  144 => 49,  136 => 47,  127 => 45,  125 => 44,  122 => 43,  120 => 42,  111 => 35,  105 => 32,  102 => 31,  100 => 30,  96 => 28,  90 => 26,  88 => 25,  77 => 16,  71 => 15,  69 => 14,  60 => 8,  56 => 7,  51 => 6,  48 => 5,  45 => 4,  43 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/gavias_lozin/templates/page/header-1.html.twig", "/var/www/html/calpemar.com/themes/gavias_lozin/templates/page/header-1.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 3, "if" => 4);
        static $filters = array("escape" => 7, "t" => 45, "raw" => 62);
        static $functions = array("gva_theme_setting" => 8, "path" => 47, "file_url" => 55);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape', 't', 'raw'],
                ['gva_theme_setting', 'path', 'file_url']
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
