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

/* themes/gavias_lozin/templates/user/page--user--edit.html.twig */
class __TwigTemplate_3010387a6dd6f585985618a58306bc86 extends Template
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
        // line 7
        echo "
<div class=\"page-user-edit gva-body-page body-page\">
   <div class=\"bg\"></div>
   <div role=\"main\" class=\"main main-page\">
      <div class=\"branding text-center\">
         ";
        // line 12
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "branding", [], "any", false, false, true, 12)) {
            // line 13
            echo "            ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "branding", [], "any", false, false, true, 13), 13, $this->source), "html", null, true);
            echo "
         ";
        }
        // line 15
        echo "      </div>
      <div class=\"page-use-main-content\">
         ";
        // line 17
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "help", [], "any", false, false, true, 17)) {
            // line 18
            echo "            <div class=\"help show\">
               <div class=\"container\">
                  <div class=\"content-inner\">
                     ";
            // line 21
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "help", [], "any", false, false, true, 21), 21, $this->source), "html", null, true);
            echo "
                  </div>
               </div>
            </div>
         ";
        }
        // line 26
        echo "         <div class=\"clearfix\"></div>
         <div id=\"content\" class=\"content content-full\">
            ";
        // line 28
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 28)) {
            // line 29
            echo "               <div class=\"content-main\">
                  ";
            // line 30
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 30), 30, $this->source), "html", null, true);
            echo "
               </div>
            ";
        }
        // line 33
        echo "         </div>
      </div>   
   </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "themes/gavias_lozin/templates/user/page--user--edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 33,  82 => 30,  79 => 29,  77 => 28,  73 => 26,  65 => 21,  60 => 18,  58 => 17,  54 => 15,  48 => 13,  46 => 12,  39 => 7,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/gavias_lozin/templates/user/page--user--edit.html.twig", "/var/www/html/calpemar.com/themes/gavias_lozin/templates/user/page--user--edit.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 12);
        static $filters = array("escape" => 13);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape'],
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
