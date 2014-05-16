<?php

/* EchyzenNewsBundle::layout.html.twig */
class __TwigTemplate_89ee7b2b49e87426318921a4490a4c5a24f4df4d09de3e895e2f5d8ecfc454c7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
            'echyzen_news_body' => array($this, 'block_echyzen_news_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        // line 6
        echo "  ";
        $this->displayParentBlock("title", $context, $blocks);
        echo " - News
";
    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        // line 12
        echo "\t  ";
        // line 13
        echo "\t<div id=\"bandeau\"><h1>News</h1><div id=\"bandeau_centre\"></div></div>
 

\t<div id=\"corps_bis\">

\t\t<div id=\"news1\">
\t\t\t";
        // line 20
        echo "\t\t\t";
        $this->displayBlock('echyzen_news_body', $context, $blocks);
        // line 22
        echo "\t\t\t<div id=\"news1bis\">
\t\t\t</div>
\t\t</div>
\t\t\t<div id=\"categorie\">
\t\t<p>
\t\t\tCeci est un test\t\tlol c'est un simple test
\t\t\tje repete un teste<br />
\t\t</p>
\t</div>

\t</div>


";
    }

    // line 20
    public function block_echyzen_news_body($context, array $blocks = array())
    {
        // line 21
        echo "\t\t\t";
    }

    public function getTemplateName()
    {
        return "EchyzenNewsBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 21,  73 => 20,  56 => 22,  53 => 20,  45 => 13,  43 => 12,  33 => 6,  30 => 5,  49 => 8,  40 => 11,  36 => 5,  31 => 4,  28 => 3,);
    }
}
