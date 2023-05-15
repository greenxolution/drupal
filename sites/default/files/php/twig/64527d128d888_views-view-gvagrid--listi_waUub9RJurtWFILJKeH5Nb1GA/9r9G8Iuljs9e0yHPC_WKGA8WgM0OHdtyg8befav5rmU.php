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

/* themes/gavias_lozin/templates/listings/views/views-view-gvagrid--listing-map-block.html.twig */
class __TwigTemplate_6e57e3a5378885c2b344c1582eb36a3a extends Template
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
        if ((($this->extensions['Drupal\gavias_hook_themer\TwigExtension']->themeSetting("map_source") == "google") || ($this->extensions['Drupal\gavias_hook_themer\TwigExtension']->themeSetting("map_source") == ""))) {
            // line 2
            echo "  ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("gavias_lozin/listing_init.gmap"), "html", null, true);
            echo "
";
        }
        // line 3
        echo " 
";
        // line 4
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("gavias_lozin/listing_init"), "html", null, true);
        echo "

";
        // line 6
        if (($context["attributes"] ?? null)) {
            // line 7
            echo "<div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null), 7, $this->source), "html", null, true);
            echo ">
";
        }
        // line 9
        echo "   
  ";
        // line 10
        if (($context["title"] ?? null)) {
            // line 11
            echo "    <h3>";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 11, $this->source), "html", null, true);
            echo "</h3>
  ";
        }
        // line 13
        echo "  
  <div class=\"listings-map-page gva-listings-map-page\">
    <div class=\"map-layout-full clearfix\">
      <div class=\"main-listing-wrapper\">
      
        <div class=\"map-action clearfix\">
          <div class=\"control-search-link\"><a href=\"";
        // line 19
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["base_url"] ?? null), 19, $this->source), "html", null, true);
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\gavias_hook_themer\TwigExtension']->themeSetting("listing_search_action"), "html", null, true);
        echo "\">";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Search Page"));
        echo "</a></div>
          <div class=\"control-map\">
            <div class=\"control-reset-map\"><a href=\"#\" class=\"gva-reset-map\"><i class=\"la la-map-marker\"></i>";
        // line 21
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Reset Map"));
        echo "</a></div>
            <div class=\"control-current-map\"><a href=\"#\" class=\"gva-current-map\"></a></div>
          </div>  
        </div>  

        <div class=\"d-none listing-items gva-view-grid-inner lg-block-grid-";
        // line 26
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["class_grid"] ?? null), "items_lg", [], "any", false, false, true, 26), 26, $this->source), "html", null, true);
        echo " md-block-grid-";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["class_grid"] ?? null), "items_md", [], "any", false, false, true, 26), 26, $this->source), "html", null, true);
        echo " sm-block-grid-";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["class_grid"] ?? null), "items_sm", [], "any", false, false, true, 26), 26, $this->source), "html", null, true);
        echo " xs-block-grid-";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["class_grid"] ?? null), "items_xs", [], "any", false, false, true, 26), 26, $this->source), "html", null, true);
        echo "\" data-drupal-views-infinite-scroll-content-wrapper-gvaloadmorelistings>
          ";
        // line 27
        $context["i"] = 0;
        // line 28
        echo "          ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["rows"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 29
            echo "              <div class=\"item-columns\">
                <div class=\"listing-item-wrapper\" data-marker=\"";
            // line 30
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["i"] ?? null), 30, $this->source), "html", null, true);
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["row"], "content", [], "any", false, false, true, 30), 30, $this->source));
            echo "</div>
              </div>
          ";
            // line 32
            $context["i"] = (($context["i"] ?? null) + 1);
            // line 33
            echo "          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        echo "        </div>
      </div>  
      <div class=\"main-map-wrapper\">
        <div id=\"listing-main-map\" class=\"listing-main-map\"></div>
      </div>
    </div>  
  </div>  
  
";
        // line 42
        if (($context["attributes"] ?? null)) {
            // line 43
            echo "</div>
";
        }
        // line 45
        echo "

<script type=\"text/javascript\">
  jQuery(document).ready(function(){
    map_init();
  });
</script>";
    }

    public function getTemplateName()
    {
        return "themes/gavias_lozin/templates/listings/views/views-view-gvagrid--listing-map-block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  149 => 45,  145 => 43,  143 => 42,  133 => 34,  127 => 33,  125 => 32,  118 => 30,  115 => 29,  110 => 28,  108 => 27,  98 => 26,  90 => 21,  82 => 19,  74 => 13,  68 => 11,  66 => 10,  63 => 9,  57 => 7,  55 => 6,  50 => 4,  47 => 3,  41 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/gavias_lozin/templates/listings/views/views-view-gvagrid--listing-map-block.html.twig", "/var/www/html/calpemar.com/themes/gavias_lozin/templates/listings/views/views-view-gvagrid--listing-map-block.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 1, "set" => 27, "for" => 28);
        static $filters = array("escape" => 2, "t" => 19, "raw" => 30);
        static $functions = array("gva_theme_setting" => 1, "attach_library" => 2);

        try {
            $this->sandbox->checkSecurity(
                ['if', 'set', 'for'],
                ['escape', 't', 'raw'],
                ['gva_theme_setting', 'attach_library']
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
