<?php

/* ::layout.html.twig */
class __TwigTemplate_ea9abcc56754c237e171268b7cbb570056134ccc3dcc6d15a2a724194cbe134b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheet' => array($this, 'block_stylesheet'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
\t<head>
\t\t<title>";
        // line 4
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
\t\t<meta name=\"description\" content=\"portofolio, Tutoriels/astuces et galerie 3D/2D!!!\" />
\t\t<meta name=\"keywords\" content=\"portofolio, galerie, infographie, informatique, programmation, zbrush, blender, html, css, php, ...\" />
\t\t<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
\t\t";
        // line 8
        $this->displayBlock('stylesheet', $context, $blocks);
        // line 18
        echo "\t</head>


\t\t\t
\t<body>
\t<div id=\"header_bandeau\">
\t\t<header>
\t\t</header>
\t</div>
<div id=\"test\">
<nav>
\t<div id=\"signature\">
\t</div>
\t\t\t
\t<div id=\"barreMenu\">

\t\t\t<a href=\"/news.php\" class=\"elementMenu\">News</a>
\t\t\t<a href=\"/galerie/galerie.php\" class=\"elementMenu\">Galerie</a>
\t\t\t<a href=\"/projets/projet.php\" class=\"elementMenu\">Projet</a>
\t\t\t<a href=\"/tests/test.php\" class=\"elementMenu\">Test</a>
\t\t\t<a href=\"/tutos/tuto.php\" class=\"elementMenu\">Tuto</a>
\t\t\t<a href=\"/site/site.php\" class=\"elementMenu\">Site</a>
\t\t\t<a href=\"/forum/forum.php\" class=\"elementMenu\">Forum</a>
\t\t\t<!--<a href=\"http://www.youtube.com/user/EchyzenChannel\" title=\"La chaine YouTube du Portofolio\" target=\"_blank\"><div class=\"logo1\"></div></a>
\t\t\t<a href=\"https://vimeo.com/channels/echyzen\" title=\"La chaîne Vimeo du Portofolio\" target=\"_blank\"><div class=\"logo2\"></div></a>
\t-->
\t</div>
</nav>
</div>

";
        // line 69
        echo "
\t\t<div id=\"corps\">
\t\t\t";
        // line 71
        $this->displayBlock('body', $context, $blocks);
        // line 73
        echo "\t\t</div>
\t\t<footer> 
\t\t\t<div id=\"cadre_footer\">
\t\t\t\t<div id=\"rond1\"><img src=\"/css/images/rond1.png\" alt=\"un rond\" /></div>
\t\t\t\t<div id=\"rond2\"><img src=\"/css/images/rond1.png\" alt=\"un rond\" /></div>
\t\t\t\t<div id=\"rond3\"><img src=\"/css/images/rond3.png\" alt=\"un rond\" /></div>
\t\t\t\t<div id=\"rond4\"><img src=\"/css/images/rond3.png\" alt=\"un rond\" /></div>
\t\t\t\t<div id=\"rond5\"><img src=\"/css/images/rond2.png\" alt=\"un rond\" /></div>
\t\t\t\t<div id=\"rond6\"><img src=\"/css/images/rond1.png\" alt=\"un rond\" /></div>
\t\t\t\t<p>
\t\t\t\t\tCopyright © 2012 - ";
        // line 83
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo " - Echyzen - Tous droits réservés <br />
\t\t\t\t\tVersion 0.2.1<br />
\t\t\t\t</p> 
\t\t\t</div>
\t\t</footer>\t
\t\t
\t\t";
        // line 89
        $this->displayBlock('javascripts', $context, $blocks);
        // line 93
        echo "\t</body>
</html>";
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
        echo "Echyzen - Portfolio";
    }

    // line 8
    public function block_stylesheet($context, array $blocks = array())
    {
        // line 9
        echo "\t\t\t<link rel=\"stylesheet\" media=\"screen\" type=\"text/css\" title=\"Design\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/design.css"), "html", null, true);
        echo "\" />
\t\t\t<link rel=\"shortcut icon\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/favicon.ico"), "html", null, true);
        echo "\" >
\t\t\t<!-- Icon Apple touch -->
\t\t\t<link rel=\"apple-touch-icon\" href= \"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/icon_apple.png"), "html", null, true);
        echo "\" />
\t\t\t<!-- Icon Windows 8 -->
\t\t\t<meta name=\"application-name\" content=\"Echyzen Portofolio's\"/> 
\t\t\t<meta name=\"msapplication-TileColor\" content=\"#58595B\" /> 
\t\t\t<meta name=\"msapplication-TileImage\" content=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/icon_microsoft.png"), "html", null, true);
        echo "\" />
\t\t";
    }

    // line 71
    public function block_body($context, array $blocks = array())
    {
        // line 72
        echo "\t\t\t";
    }

    // line 89
    public function block_javascripts($context, array $blocks = array())
    {
        // line 90
        echo "\t\t\t<script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js\"></script>
\t\t\t<script src=\"";
        // line 91
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("/js/design_effect.js"), "html", null, true);
        echo "\" type=\"text/javascript\" ></script>
\t\t";
    }

    public function getTemplateName()
    {
        return "::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  148 => 91,  145 => 90,  142 => 89,  138 => 72,  135 => 71,  129 => 16,  122 => 12,  117 => 10,  112 => 9,  109 => 8,  103 => 4,  98 => 93,  96 => 89,  87 => 83,  75 => 73,  69 => 69,  37 => 18,  35 => 8,  23 => 1,  76 => 21,  73 => 71,  56 => 22,  53 => 20,  45 => 13,  43 => 12,  33 => 6,  30 => 5,  49 => 8,  40 => 11,  36 => 5,  31 => 4,  28 => 4,);
    }
}
