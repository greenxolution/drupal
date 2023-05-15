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

/* themes/gavias_lozin/templates/views/views-view-unformatted--taxonomy-term.html.twig */
class __TwigTemplate_1964c97925f5552f5204ace554686b70 extends Template
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
        // line 20
        if (($context["title"] ?? null)) {
            // line 21
            echo "  <h3>";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 21, $this->source), "html", null, true);
            echo "</h3>
";
        }
        // line 23
        echo "

";
        // line 25
        if ((((($context["taxonomy_id"] ?? null) == "listing_category") || (($context["taxonomy_id"] ?? null) == "listing_locations")) || (($context["taxonomy_id"] ?? null) == "amenities"))) {
            echo " ";
            // line 26
            echo "   
  ";
            // line 27
            if (($context["attributes"] ?? null)) {
                // line 28
                echo "<div";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null), 28, $this->source), "html", null, true);
                echo ">
  ";
            }
            // line 30
            echo "     
    ";
            // line 31
            if (($context["title"] ?? null)) {
                // line 32
                echo "      <h3>";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 32, $this->source), "html", null, true);
                echo "</h3>
    ";
            }
            // line 34
            echo "    <div class=\"gva-listings-map-page\">
      <div class=\"listings-map-3 map-layout-wrapper\">
        <div class=\"half-map-layout-1 clearfix\">
          <div class=\"map-action-mobile clearfix\">
            <div class=\"control-search-link\"><a class=\"btn-theme-small\" href=\"";
            // line 38
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getPath("<front>"));
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\gavias_hook_themer\TwigExtension']->themeSetting("listing_search_action"), "html", null, true);
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Search Page"));
            echo "</a></div>
            <div class=\"control-map\">
              <div class=\"control-reset-map\"><a href=\"#\" class=\"btn-theme-small gva-reset-map\">";
            // line 40
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Reset Map"));
            echo "</a></div>
              <div class=\"control-open-map-listtings\">
                <a href=\"#\" class=\"btn-theme-small gva-open-map\">";
            // line 42
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar("Open Map");
            echo "</a>
                <a href=\"#\" class=\"btn-theme-small gva-open-listings d-none\">";
            // line 43
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar("Open Listings");
            echo "</a>
              </div>
            </div>
          </div>
          
          <div class=\"main-listing-wrapper d-lg-block\">
            <div class=\"map-action clearfix d-none d-md-none d-sm-none d-lg-block\">
              <div class=\"control-search-2\" style=\"float:left;\"><a href=\"";
            // line 50
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->getPath("<front>"));
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\gavias_hook_themer\TwigExtension']->themeSetting("listing_search_action"), "html", null, true);
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Search Filters Page"));
            echo "</a></div>
              <div class=\"control-map\">
                <div class=\"control-hover-show-map pretty p-switch p-fill\">
                  <input type=\"checkbox\" id=\"hover-show-map\"/>
                  <div class=\"state\">
                      <label>";
            // line 55
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Hover Show Map"));
            echo "</label>
                  </div>
                </div>
                <div class=\"control-reset-map\"><a href=\"#\" class=\"gva-reset-map\"><i class=\"la la-map-marker\"></i>";
            // line 58
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Reset Map"));
            echo "</a></div>
              </div>  
            </div>  

            <div class=\"listing-items gva-view-grid-inner lg-block-grid-3 md-block-grid-3 sm-block-grid-2 xs-block-grid-2\" data-drupal-views-infinite-scroll-content-wrapper-gvaloadmorelistings>
              ";
            // line 63
            $context["i"] = 0;
            // line 64
            echo "              ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["rows"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 65
                echo "                  <div class=\"item-columns\">
                    <div class=\"listing-item-wrapper\" data-marker=\"";
                // line 66
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["i"] ?? null), 66, $this->source), "html", null, true);
                echo "\">";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["row"], "content", [], "any", false, false, true, 66), 66, $this->source));
                echo "</div>
                  </div>
              ";
                // line 68
                $context["i"] = (($context["i"] ?? null) + 1);
                // line 69
                echo "              ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 70
            echo "            </div>
          </div> 

          <div class=\"main-map-wrapper d-none d-md-none d-sm-none d-xs-none d-lg-block\">
            <div id=\"listing-main-map\" class=\"listing-main-map\"></div>
          </div>
        </div>  
      </div>  
    </div>
  ";
            // line 79
            if (($context["attributes"] ?? null)) {
                // line 80
                echo "</div>
  ";
            }
            // line 82
            echo "

  <script type=\"text/javascript\">
    jQuery(document).ready(function(){
      map_init();
    });
  </script>


";
        } else {
            // line 91
            echo " ";
            // line 92
            echo "
  ";
            // line 93
            $context["i"] = 0;
            // line 94
            echo "  <div class=\"categories-view-content view-content-wrap post-style-grid box\">
    ";
            // line 95
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["rows"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 96
                echo "      ";
                $context["i"] = (($context["i"] ?? null) + 1);
                // line 97
                echo "      ";
                if (((($context["i"] ?? null) % 2) == 1)) {
                    echo " 
        <div class=\"row\">
      ";
                }
                // line 99
                echo " 
        <div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12\">
          ";
                // line 101
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["row"], "content", [], "any", false, false, true, 101), 101, $this->source), "html", null, true);
                echo "
        </div>
      ";
                // line 103
                if ((((($context["i"] ?? null) % 2) == 0) || (($context["i"] ?? null) == twig_length_filter($this->env, ($context["rows"] ?? null))))) {
                    echo " 
        </div>
      ";
                }
                // line 105
                echo " 
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 107
            echo "  </div>
";
        }
    }

    public function getTemplateName()
    {
        return "themes/gavias_lozin/templates/views/views-view-unformatted--taxonomy-term.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  234 => 107,  227 => 105,  221 => 103,  216 => 101,  212 => 99,  205 => 97,  202 => 96,  198 => 95,  195 => 94,  193 => 93,  190 => 92,  188 => 91,  176 => 82,  172 => 80,  170 => 79,  159 => 70,  153 => 69,  151 => 68,  144 => 66,  141 => 65,  136 => 64,  134 => 63,  126 => 58,  120 => 55,  109 => 50,  99 => 43,  95 => 42,  90 => 40,  82 => 38,  76 => 34,  70 => 32,  68 => 31,  65 => 30,  59 => 28,  57 => 27,  54 => 26,  51 => 25,  47 => 23,  41 => 21,  39 => 20,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/gavias_lozin/templates/views/views-view-unformatted--taxonomy-term.html.twig", "/var/www/html/calpemar.com/themes/gavias_lozin/templates/views/views-view-unformatted--taxonomy-term.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 20, "set" => 63, "for" => 64);
        static $filters = array("escape" => 21, "t" => 38, "raw" => 66, "length" => 103);
        static $functions = array("path" => 38, "gva_theme_setting" => 38);

        try {
            $this->sandbox->checkSecurity(
                ['if', 'set', 'for'],
                ['escape', 't', 'raw', 'length'],
                ['path', 'gva_theme_setting']
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
