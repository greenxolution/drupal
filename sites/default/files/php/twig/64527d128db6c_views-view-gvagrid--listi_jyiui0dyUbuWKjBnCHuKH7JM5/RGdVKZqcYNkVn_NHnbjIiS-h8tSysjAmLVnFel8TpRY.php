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

/* themes/gavias_lozin/templates/listings/views/views-view-gvagrid--listing-full-two.html.twig */
class __TwigTemplate_9a3e69e118dd64c244c088ebc00ec689 extends Template
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
        echo "  <div class=\"main-map-wrapper\">
    <div id=\"listing-main-map\" class=\"listing-main-map listing-main-map-4\" style=\"height: 600px;\"></div>
  </div>
  ";
        // line 4
        if (($context["attributes"] ?? null)) {
            // line 5
            echo "<div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null), 5, $this->source), "html", null, true);
            echo ">
  ";
        }
        // line 7
        echo "
  <div class=\"map-layout map-layout-wrapper clearfix\">

    <div class=\"main-listing-wrapper d-lg-block\">
      <div class=\"map-action clearfix d-none d-md-none d-sm-none d-xs-none d-lg-block\">
        <div class=\"control-map\">
          <div class=\"control-hover-show-map pretty p-switch p-fill\">
            <input type=\"checkbox\" id=\"hover-show-map\"/>
            <div class=\"state\">
                <label>";
        // line 16
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Hover Show Map"));
        echo "</label>
            </div>
          </div>
          <div class=\"control-reset-map\"><a href=\"#\" class=\"gva-reset-map btn-theme-small\">";
        // line 19
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Reset Map"));
        echo "</a></div>
          <div class=\"control-current-map\"><a href=\"#\" class=\"gva-current-map\"></a></div>
        </div>  
      </div>  

      <div class=\"listing-items gva-view-grid-inner lg-block-grid-";
        // line 24
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["class_grid"] ?? null), "items_lg", [], "any", false, false, true, 24), 24, $this->source), "html", null, true);
        echo " md-block-grid-";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["class_grid"] ?? null), "items_md", [], "any", false, false, true, 24), 24, $this->source), "html", null, true);
        echo " sm-block-grid-";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["class_grid"] ?? null), "items_sm", [], "any", false, false, true, 24), 24, $this->source), "html", null, true);
        echo " xs-block-grid-";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["class_grid"] ?? null), "items_xs", [], "any", false, false, true, 24), 24, $this->source), "html", null, true);
        echo "\" data-drupal-views-infinite-scroll-content-wrapper-gvaloadmorelistings>
        ";
        // line 25
        $context["i"] = 0;
        // line 26
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["rows"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 27
            echo "            <div class=\"item-columns\">
              <div class=\"listing-item-wrapper\" data-marker=\"";
            // line 28
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["i"] ?? null), 28, $this->source), "html", null, true);
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["row"], "content", [], "any", false, false, true, 28), 28, $this->source));
            echo "</div>
            </div>
        ";
            // line 30
            $context["i"] = (($context["i"] ?? null) + 1);
            // line 31
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        echo "      </div>
    </div>  

  </div>  
  
";
        // line 37
        if (($context["attributes"] ?? null)) {
            // line 38
            echo "</div>
";
        }
        // line 40
        echo "
<script type=\"text/javascript\">
  jQuery(document).ready(function(){
    map_init();
  });
</script>";
    }

    public function getTemplateName()
    {
        return "themes/gavias_lozin/templates/listings/views/views-view-gvagrid--listing-full-two.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  125 => 40,  121 => 38,  119 => 37,  112 => 32,  106 => 31,  104 => 30,  97 => 28,  94 => 27,  89 => 26,  87 => 25,  77 => 24,  69 => 19,  63 => 16,  52 => 7,  46 => 5,  44 => 4,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/gavias_lozin/templates/listings/views/views-view-gvagrid--listing-full-two.html.twig", "/var/www/html/calpemar.com/themes/gavias_lozin/templates/listings/views/views-view-gvagrid--listing-full-two.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 4, "set" => 25, "for" => 26);
        static $filters = array("escape" => 5, "t" => 16, "raw" => 28);
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
