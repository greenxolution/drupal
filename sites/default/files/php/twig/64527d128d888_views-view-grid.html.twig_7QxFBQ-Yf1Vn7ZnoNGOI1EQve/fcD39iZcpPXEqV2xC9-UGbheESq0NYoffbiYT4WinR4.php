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

/* themes/gavias_lozin/templates/views/views-view-grid.html.twig */
class __TwigTemplate_92a4dd2aaae12e7dd20ea51cc6f27442 extends Template
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
        // line 30
        $context["classes"] = [0 => "views-view-grid", 1 => twig_get_attribute($this->env, $this->source,         // line 32
($context["gva_masonry"] ?? null), "class", [], "any", false, false, true, 32), 2 => twig_get_attribute($this->env, $this->source,         // line 33
($context["options"] ?? null), "alignment", [], "any", false, false, true, 33), 3 => "clearfix"];
        // line 37
        echo "
  ";
        // line 38
        if ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "columns", [], "any", false, false, true, 38) == "1")) {
            // line 39
            echo "    ";
            $context["xclass"] = [0 => "col-lg-12 col-md-12 col-sm-12 col-xs-12"];
            // line 40
            echo "  ";
        } elseif ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "columns", [], "any", false, false, true, 40) == "2")) {
            // line 41
            echo "    ";
            $context["xclass"] = [0 => "col-lg-6 col-md-6 col-sm-12 col-xs-12"];
            // line 42
            echo "  ";
        } elseif ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "columns", [], "any", false, false, true, 42) == "3")) {
            // line 43
            echo "    ";
            $context["xclass"] = [0 => "col-lg-4 col-md-4 col-sm-12 col-xs-12"];
            // line 44
            echo "  ";
        } elseif ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "columns", [], "any", false, false, true, 44) == "4")) {
            // line 45
            echo "    ";
            $context["xclass"] = [0 => "col-lg-3 col-md-3 col-sm-12 col-xs-12"];
            // line 46
            echo "  ";
        } elseif ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "columns", [], "any", false, false, true, 46) == "6")) {
            // line 47
            echo "    ";
            $context["xclass"] = [0 => "col-lg-2 col-md-2 col-sm-6 col-xs-12"];
            // line 48
            echo "  ";
        } else {
            // line 49
            echo "    ";
            $context["xclass"] = [0 => "col-lg-4 col-md-4 col-sm-12 col-xs-12"];
            // line 50
            echo "  ";
        }
        echo "  

";
        // line 52
        if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "row_class_default", [], "any", false, false, true, 52)) {
            // line 53
            echo "  ";
            // line 54
            $context["row_classes"] = [0 => "views-row row", 1 => (((twig_get_attribute($this->env, $this->source,             // line 56
($context["options"] ?? null), "alignment", [], "any", false, false, true, 56) == "horizontal")) ? ("clearfix") : (""))];
        }
        // line 60
        if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "col_class_default", [], "any", false, false, true, 60)) {
            // line 61
            echo "  ";
            // line 62
            $context["col_classes"] = [0 => "views-col", 1 => (((twig_get_attribute($this->env, $this->source,             // line 64
($context["options"] ?? null), "alignment", [], "any", false, false, true, 64) == "vertical")) ? ("clearfix") : (""))];
        }
        // line 68
        if (($context["title"] ?? null)) {
            // line 69
            echo "  <h3>";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 69, $this->source), "html", null, true);
            echo "</h3>
";
        }
        // line 71
        echo "<div";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method", false, false, true, 71), 71, $this->source), "html", null, true);
        echo ">
  ";
        // line 72
        if ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "alignment", [], "any", false, false, true, 72) == "horizontal")) {
            // line 73
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 74
                echo "      
      ";
                // line 75
                if ((twig_get_attribute($this->env, $this->source, ($context["gva_masonry"] ?? null), "class", [], "any", false, false, true, 75) == "")) {
                    // line 76
                    echo "        <div";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["row"], "attributes", [], "any", false, false, true, 76), "addClass", [0 => ($context["row_classes"] ?? null), 1 => ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "row_class_default", [], "any", false, false, true, 76)) ? (("row-" . $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, true, 76), 76, $this->source))) : (""))], "method", false, false, true, 76), 76, $this->source), "html", null, true);
                    echo ">
      ";
                }
                // line 77
                echo "  

        ";
                // line 79
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["row"], "content", [], "any", false, false, true, 79));
                foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
                    // line 80
                    echo "          <div";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["column"], "attributes", [], "any", false, false, true, 80), "addClass", [0 => ($context["col_classes"] ?? null), 1 => ($context["xclass"] ?? null), 2 => twig_get_attribute($this->env, $this->source, ($context["gva_masonry"] ?? null), "class_item", [], "any", false, false, true, 80)], "method", false, false, true, 80), 80, $this->source), "html", null, true);
                    echo ">
            ";
                    // line 81
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["column"], "content", [], "any", false, false, true, 81), 81, $this->source), "html", null, true);
                    echo "
          </div>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 84
                echo "      
      ";
                // line 85
                if ((twig_get_attribute($this->env, $this->source, ($context["gva_masonry"] ?? null), "class", [], "any", false, false, true, 85) == "")) {
                    // line 86
                    echo "        </div>
      ";
                }
                // line 87
                echo "  

    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 90
            echo "  ";
        } else {
            // line 91
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
                // line 92
                echo "      <div";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["column"], "attributes", [], "any", false, false, true, 92), "addClass", [0 => ($context["col_classes"] ?? null), 1 => ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "col_class_default", [], "any", false, false, true, 92)) ? (("col-" . $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, true, 92), 92, $this->source))) : ("")), 2 => ($context["xclass"] ?? null)], "method", false, false, true, 92), 92, $this->source), "html", null, true);
                echo ">
        ";
                // line 93
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["column"], "content", [], "any", false, false, true, 93));
                $context['loop'] = [
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                ];
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                    // line 94
                    echo "          <div";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["row"], "attributes", [], "any", false, false, true, 94), "addClass", [0 => ($context["row_classes"] ?? null), 1 => ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "row_class_default", [], "any", false, false, true, 94)) ? (("row-" . $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, true, 94), 94, $this->source))) : (""))], "method", false, false, true, 94), 94, $this->source), "html", null, true);
                    echo ">
            ";
                    // line 95
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["row"], "content", [], "any", false, false, true, 95), 95, $this->source), "html", null, true);
                    echo "
          </div>
        ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 98
                echo "      </div>
    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 100
            echo "  ";
        }
        // line 101
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "themes/gavias_lozin/templates/views/views-view-grid.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  277 => 101,  274 => 100,  259 => 98,  242 => 95,  237 => 94,  220 => 93,  215 => 92,  197 => 91,  194 => 90,  178 => 87,  174 => 86,  172 => 85,  169 => 84,  160 => 81,  155 => 80,  151 => 79,  147 => 77,  141 => 76,  139 => 75,  136 => 74,  118 => 73,  116 => 72,  111 => 71,  105 => 69,  103 => 68,  100 => 64,  99 => 62,  97 => 61,  95 => 60,  92 => 56,  91 => 54,  89 => 53,  87 => 52,  81 => 50,  78 => 49,  75 => 48,  72 => 47,  69 => 46,  66 => 45,  63 => 44,  60 => 43,  57 => 42,  54 => 41,  51 => 40,  48 => 39,  46 => 38,  43 => 37,  41 => 33,  40 => 32,  39 => 30,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/gavias_lozin/templates/views/views-view-grid.html.twig", "/var/www/html/calpemar.com/themes/gavias_lozin/templates/views/views-view-grid.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 30, "if" => 38, "for" => 73);
        static $filters = array("escape" => 69);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'for'],
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
