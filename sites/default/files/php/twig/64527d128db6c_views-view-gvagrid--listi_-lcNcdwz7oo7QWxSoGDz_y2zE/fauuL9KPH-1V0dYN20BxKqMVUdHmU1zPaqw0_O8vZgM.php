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

/* themes/gavias_lozin/templates/listings/views/views-view-gvagrid--listing-map-one.html.twig */
class __TwigTemplate_512bf9f50aa931e5f98e0708dc353337 extends Template
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
        echo " 
";
        // line 2
        if (($context["attributes"] ?? null)) {
            // line 3
            echo "<div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null), 3, $this->source), "html", null, true);
            echo ">
";
        }
        // line 5
        echo "   
  ";
        // line 6
        if (($context["title"] ?? null)) {
            // line 7
            echo "    <h3>";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 7, $this->source), "html", null, true);
            echo "</h3>
  ";
        }
        // line 9
        echo "  <div class=\"map-layout map-layout-wrapper clearfix\">
    <div class=\"map-action-mobile clearfix\">
      <div class=\"control-search\"><a class=\"btn-theme-small\" href=\"#\">";
        // line 11
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Search Filters"));
        echo "</a></div>
      <div class=\"control-map\">
        <div class=\"control-current-map\"><a href=\"#\" class=\"gva-current-map\"></a></div>        
        <div class=\"control-reset-map\"><a href=\"#\" class=\"btn-theme-small gva-reset-map\">";
        // line 14
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Reset Map"));
        echo "</a></div>
        <div class=\"control-open-map-listtings\">
          <a href=\"#\" class=\"btn-theme-small gva-open-map\">";
        // line 16
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar("Open Map");
        echo "</a>
          <a href=\"#\" class=\"btn-theme-small gva-open-listings d-none\">";
        // line 17
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar("Open Listings");
        echo "</a>
        </div>
      </div>
    </div>
    <div class=\"main-listing-wrapper d-lg-block\">
      <div class=\"map-action clearfix d-none d-md-none d-sm-none d-xs-none d-lg-block\">
        <div class=\"control-search\"><a class=\"btn-theme-small\" href=\"#\">";
        // line 23
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Search Filters"));
        echo "</a></div>
        <div class=\"control-map\">
          <div class=\"control-hover-show-map pretty p-switch p-fill\">
            <input type=\"checkbox\" id=\"hover-show-map\"/>
            <div class=\"state\">
                <label>";
        // line 28
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Hover Show Map"));
        echo "</label>
            </div>
          </div>
          <div class=\"control-reset-map\"><a href=\"#\" class=\"gva-reset-map btn-theme-small\">";
        // line 31
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Reset Map"));
        echo "</a></div>
          <div class=\"control-current-map\"><a href=\"#\" class=\"gva-current-map\"></a></div>
        </div>  
      </div>  

      <div class=\"listing-items gva-view-grid-inner lg-block-grid-";
        // line 36
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["class_grid"] ?? null), "items_lg", [], "any", false, false, true, 36), 36, $this->source), "html", null, true);
        echo " md-block-grid-";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["class_grid"] ?? null), "items_md", [], "any", false, false, true, 36), 36, $this->source), "html", null, true);
        echo " sm-block-grid-";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["class_grid"] ?? null), "items_sm", [], "any", false, false, true, 36), 36, $this->source), "html", null, true);
        echo " xs-block-grid-";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["class_grid"] ?? null), "items_xs", [], "any", false, false, true, 36), 36, $this->source), "html", null, true);
        echo "\" data-drupal-views-infinite-scroll-content-wrapper-gvaloadmorelistings>
        ";
        // line 37
        $context["i"] = 0;
        // line 38
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["rows"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 39
            echo "            <div class=\"item-columns\">
              <div class=\"listing-item-wrapper\" data-marker=\"";
            // line 40
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["i"] ?? null), 40, $this->source), "html", null, true);
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["row"], "content", [], "any", false, false, true, 40), 40, $this->source));
            echo "</div>
            </div>
        ";
            // line 42
            $context["i"] = (($context["i"] ?? null) + 1);
            // line 43
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        echo "      </div>
    </div>  
    <div class=\"main-map-wrapper d-none d-md-none d-sm-none d-xs-none d-lg-block\">
      <div id=\"listing-main-map\" class=\"listing-main-map\"></div>
    </div>
  </div>  
  
";
        // line 51
        if (($context["attributes"] ?? null)) {
            // line 52
            echo "</div>
";
        }
        // line 54
        echo "

<script type=\"text/javascript\">
  jQuery(document).ready(function(){
    map_init();
  });
</script>";
    }

    public function getTemplateName()
    {
        return "themes/gavias_lozin/templates/listings/views/views-view-gvagrid--listing-map-one.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  161 => 54,  157 => 52,  155 => 51,  146 => 44,  140 => 43,  138 => 42,  131 => 40,  128 => 39,  123 => 38,  121 => 37,  111 => 36,  103 => 31,  97 => 28,  89 => 23,  80 => 17,  76 => 16,  71 => 14,  65 => 11,  61 => 9,  55 => 7,  53 => 6,  50 => 5,  44 => 3,  42 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/gavias_lozin/templates/listings/views/views-view-gvagrid--listing-map-one.html.twig", "/var/www/html/calpemar.com/themes/gavias_lozin/templates/listings/views/views-view-gvagrid--listing-map-one.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 2, "set" => 37, "for" => 38);
        static $filters = array("escape" => 3, "t" => 11, "raw" => 40);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'set', 'for'],
                ['escape', 't', 'raw'],
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
