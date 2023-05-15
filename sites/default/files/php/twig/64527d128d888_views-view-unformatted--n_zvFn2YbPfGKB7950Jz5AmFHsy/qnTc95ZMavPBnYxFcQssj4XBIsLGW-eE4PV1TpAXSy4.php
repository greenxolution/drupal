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

/* themes/gavias_lozin/templates/views/articles/views-view-unformatted--news-grid-3-2.html.twig */
class __TwigTemplate_3ebc2327d7921f9746c526901d8e76ff extends Template
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
        if (($context["attributes"] ?? null)) {
            // line 2
            echo "<div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null), 2, $this->source), "html", null, true);
            echo ">
";
        }
        // line 4
        echo "   <div class=\"news-grid-3-2\">
      ";
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_array_batch(($context["rows"] ?? null), 5));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 6
            echo "         ";
            $context["k"] = 0;
            // line 7
            echo "         ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["row"]);
            foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
                echo " 
            ";
                // line 8
                $context["k"] = (($context["k"] ?? null) + 1);
                // line 9
                echo "            ";
                if ((($context["k"] ?? null) <= 2)) {
                    // line 10
                    echo "               ";
                    if ((($context["k"] ?? null) == 1)) {
                        echo "<div class=\"posts-large lg-block-grid-2 md-block-grid-2 sm-block-grid-2 xs-block-grid-2\">";
                    }
                    // line 11
                    echo "                  <div class=\"item-columns post-item\">";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["column"], "content", [], "any", false, false, true, 11), 11, $this->source), "html", null, true);
                    echo "</div>
               ";
                    // line 12
                    if (((($context["k"] ?? null) == 2) || (($context["k"] ?? null) == twig_length_filter($this->env, $context["row"])))) {
                        echo "</div>";
                    }
                    // line 13
                    echo "            ";
                } else {
                    // line 14
                    echo "               ";
                    if ((($context["k"] ?? null) == 3)) {
                        echo " <div class=\"post-small lg-block-grid-3 md-block-grid-3 sm-block-grid-1 xs-block-grid-1\"> ";
                    }
                    // line 15
                    echo "                  <div class=\"post-item\">";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["column"], "content", [], "any", false, false, true, 15), 15, $this->source), "html", null, true);
                    echo "</div>
               ";
                    // line 16
                    if (((($context["k"] ?? null) == 5) || (($context["k"] ?? null) == twig_length_filter($this->env, $context["row"])))) {
                        echo "</div>";
                    }
                    // line 17
                    echo "            ";
                }
                // line 18
                echo "         ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 19
            echo "      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "   </div>   
";
        // line 21
        if (($context["attributes"] ?? null)) {
            // line 22
            echo "</div>
";
        }
        // line 24
        echo "

";
    }

    public function getTemplateName()
    {
        return "themes/gavias_lozin/templates/views/articles/views-view-unformatted--news-grid-3-2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  124 => 24,  120 => 22,  118 => 21,  115 => 20,  109 => 19,  103 => 18,  100 => 17,  96 => 16,  91 => 15,  86 => 14,  83 => 13,  79 => 12,  74 => 11,  69 => 10,  66 => 9,  64 => 8,  57 => 7,  54 => 6,  50 => 5,  47 => 4,  41 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/gavias_lozin/templates/views/articles/views-view-unformatted--news-grid-3-2.html.twig", "/var/www/html/calpemar.com/themes/gavias_lozin/templates/views/articles/views-view-unformatted--news-grid-3-2.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 1, "for" => 5, "set" => 6);
        static $filters = array("escape" => 2, "batch" => 5, "length" => 12);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for', 'set'],
                ['escape', 'batch', 'length'],
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
