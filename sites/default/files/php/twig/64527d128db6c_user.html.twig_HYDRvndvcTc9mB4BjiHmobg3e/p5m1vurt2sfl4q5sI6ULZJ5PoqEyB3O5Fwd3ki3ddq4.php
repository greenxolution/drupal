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

/* themes/gavias_lozin/templates/user/user.html.twig */
class __TwigTemplate_5875e4fa1df8ec556be4c214f4a71707 extends Template
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
        // line 19
        echo "<article";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => "profile user-profile"], "method", false, false, true, 19), 19, $this->source), "html", null, true);
        echo ">
   <div class=\"row\">
      ";
        // line 21
        if (($context["listings_user"] ?? null)) {
            // line 22
            echo "         <div class=\"col-xl-9 col-lg-9 col-md-8 col-sm-12 col-xs-12\">
            ";
            // line 23
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["listings_user"] ?? null), 23, $this->source), "html", null, true);
            echo "
         </div>
      ";
        }
        // line 26
        echo "
      ";
        // line 27
        if (($context["listings_user"] ?? null)) {
            // line 28
            echo "         <div class=\"col-xl-3 col-lg-3 col-md-4 col-sm-12 col-xs-12\">
      ";
        } else {
            // line 29
            echo "   
         <div class=\"col-md-12 col-xs-12\">
      ";
        }
        // line 31
        echo "   
         <div class=\"user-information\">
            ";
        // line 33
        if (twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "user_picture", [], "any", false, false, true, 33)) {
            // line 34
            echo "               <div class=\"user-picture\">
                  ";
            // line 35
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "user_picture", [], "any", false, false, true, 35), 35, $this->source), "html", null, true);
            echo "
               </div>
            ";
        }
        // line 37
        echo "    
            ";
        // line 38
        if (twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_full_name", [], "any", false, false, true, 38)) {
            // line 39
            echo "               <div class=\"user-fullname\">
                  ";
            // line 40
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_full_name", [], "any", false, false, true, 40), 40, $this->source), "html", null, true);
            echo "
               </div>
            ";
        }
        // line 42
        echo "      
            ";
        // line 43
        if (($context["content"] ?? null)) {
            // line 44
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->withoutFilter($this->sandbox->ensureToStringAllowed(($context["content"] ?? null), 44, $this->source), "user_picture", "field_full_name"), "html", null, true);
        }
        // line 46
        echo "         </div>   
      </div>
   </div>  
</article>
";
    }

    public function getTemplateName()
    {
        return "themes/gavias_lozin/templates/user/user.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  107 => 46,  104 => 44,  102 => 43,  99 => 42,  93 => 40,  90 => 39,  88 => 38,  85 => 37,  79 => 35,  76 => 34,  74 => 33,  70 => 31,  65 => 29,  61 => 28,  59 => 27,  56 => 26,  50 => 23,  47 => 22,  45 => 21,  39 => 19,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/gavias_lozin/templates/user/user.html.twig", "/var/www/html/calpemar.com/themes/gavias_lozin/templates/user/user.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 21);
        static $filters = array("escape" => 19, "without" => 44);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', 'without'],
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
