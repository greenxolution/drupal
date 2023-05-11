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

/* themes/gavias_lozin/templates/listings/page/page--view--listing-full-one.html.twig */
class __TwigTemplate_343ca8d7959f61d0b05e84c484677c9d extends Template
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

<div class=\"gva-body-wrapper gva-listings-full-page listings-full-1 clearfix\">
\t<div class=\"body-page gva-body-page\">
\t   ";
        // line 8
        $this->loadTemplate(($context["header_skin"] ?? null), "themes/gavias_lozin/templates/listings/page/page--view--listing-full-one.html.twig", 8)->display($context);
        // line 9
        echo "\t\t
\t\t";
        // line 10
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumbs", [], "any", false, false, true, 10)) {
            // line 11
            echo "\t   \t";
            $context["has_breadcrumb"] = " has-breadcrumb";
            // line 12
            echo "\t\t\t<div class=\"breadcrumbs\">
\t\t\t\t";
            // line 13
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumbs", [], "any", false, false, true, 13), 13, $this->source), "html", null, true);
            echo "
\t\t\t</div>
\t\t";
        }
        // line 16
        echo "
\t\t<div role=\"main\" class=\"main main-page\">

\t\t\t";
        // line 19
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "help", [], "any", false, false, true, 19)) {
            // line 20
            echo "\t\t\t\t<div class=\"help gav-help-region\">
\t\t\t\t\t<div class=\"container\">
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t<div class=\"content-inner col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 \">
\t\t\t\t\t\t\t\t";
            // line 24
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "help", [], "any", false, false, true, 24), 24, $this->source), "html", null, true);
            echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t";
        }
        // line 30
        echo "\t\t\t
\t\t\t<div class=\"clearfix\"></div>
\t\t\t
\t\t\t<div id=\"content\" class=\"content content-full\">
\t\t\t\t<div class=\"container\">
\t\t\t\t\t";
        // line 35
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 35)) {
            // line 36
            echo "\t\t\t\t\t\t<div class=\"content-main\">
\t\t\t\t\t\t\t";
            // line 37
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 37), 37, $this->source), "html", null, true);
            echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t";
        }
        // line 40
        echo "\t\t\t\t</div>
\t\t\t</div>

\t\t</div>
\t</div>
\t";
        // line 45
        $this->loadTemplate((($context["directory"] ?? null) . "/templates/page/footer.html.twig"), "themes/gavias_lozin/templates/listings/page/page--view--listing-full-one.html.twig", 45)->display($context);
        // line 46
        echo "</div>
<script>
jQuery(document).ready(function(){
\tjQuery('.views-exposed-form .js-form-type-checkbox').each(function(){
    \tjQuery(this).addClass('pretty p-default p-round');
    \tjQuery(this).find('label').wrap( '<div class=\"state p-success-o\"></div>' );
  });
})
</script>
";
    }

    public function getTemplateName()
    {
        return "themes/gavias_lozin/templates/listings/page/page--view--listing-full-one.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  125 => 46,  123 => 45,  116 => 40,  110 => 37,  107 => 36,  105 => 35,  98 => 30,  89 => 24,  83 => 20,  81 => 19,  76 => 16,  70 => 13,  67 => 12,  64 => 11,  62 => 10,  59 => 9,  57 => 8,  50 => 4,  47 => 3,  41 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/gavias_lozin/templates/listings/page/page--view--listing-full-one.html.twig", "/var/www/html/calpemar.com/themes/gavias_lozin/templates/listings/page/page--view--listing-full-one.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 1, "include" => 8, "set" => 11);
        static $filters = array("escape" => 2);
        static $functions = array("gva_theme_setting" => 1, "attach_library" => 2);

        try {
            $this->sandbox->checkSecurity(
                ['if', 'include', 'set'],
                ['escape'],
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
