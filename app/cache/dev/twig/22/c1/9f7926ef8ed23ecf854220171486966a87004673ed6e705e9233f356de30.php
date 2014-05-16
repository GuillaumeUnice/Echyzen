<?php

/* EchyzenNewsBundle:News:index.html.twig */
class __TwigTemplate_22c19f7926ef8ed23ecf854220171486966a87004673ed6e705e9233f356de30 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("EchyzenNewsBundle::layout.html.twig");

        $this->blocks = array(
            'echyzen_news_body' => array($this, 'block_echyzen_news_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "EchyzenNewsBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_echyzen_news_body($context, array $blocks = array())
    {
        // line 4
        echo "\t<h2>";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["new"]) ? $context["new"] : $this->getContext($context, "new")), "titre"), "html", null, true);
        echo "</h2>
\t<p>Ecrit le  ";
        // line 5
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["new"]) ? $context["new"] : $this->getContext($context, "new")), "date"), "d/m/Y à  Hhi"), "html", null, true);
        echo "</p>
\t<p><img title=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["new"]) ? $context["new"] : $this->getContext($context, "new")), "rubrique"), "html", null, true);
        echo "\" alt=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["new"]) ? $context["new"] : $this->getContext($context, "new")), "rubrique"), "html", null, true);
        echo "\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl((("../src/Echyzen/NewsBundle/Ressources/public/images/" . $this->getAttribute((isset($context["new"]) ? $context["new"] : $this->getContext($context, "new")), "rubrique")) . ".png")), "html", null, true);
        echo "\" style=\"float:left; margin-right: 15px;\" />
\t<span style=\"text-align: center;\">
\t\t";
        // line 8
        echo nl2br($this->getAttribute((isset($context["new"]) ? $context["new"] : $this->getContext($context, "new")), "contenu"));
        echo "
\t</span></p><hr />
";
    }

    public function getTemplateName()
    {
        return "EchyzenNewsBundle:News:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 8,  40 => 6,  36 => 5,  31 => 4,  28 => 3,);
    }
}
