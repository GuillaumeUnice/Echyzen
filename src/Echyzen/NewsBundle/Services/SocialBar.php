<?php

namespace Echyzen\NewsBundle\Services;

class SocialBar extends \Twig_Extension
{

    protected $twitterName;
    private $LIMIT_CHAR = 120;
    public function __construct($twitterName)
    {
        $this->twitterName  = $twitterName;
    }

    /*
    * La méthode getName() identifie votre extension Twig, elle est obligatoire
    */
    public function getName()
    {
        return 'SocialBar';
    }

    /*
    * Twig va exécuter cette méthode pour savoir quelle(s) fonction(s) ajoute notre service
    */
    public function getFunctions()
    {
        return array(
        'twitterButton' => new \Twig_Function_Method($this, 'twitterButton')
        );
    }

    public function twitterButton($url = null, $titre = null)
    {
        $result = '<a href="https://twitter.com/share" class="twitter-share-button" data-via="'
        . $this->twitterName . '" ';

        // calcul de la longueur autorisé

        if(!empty($url)) {
            $result .= 'data-url="https://' . $url . '" ';
        }

        if($titre >= LIMIT_CHAR ) {
            $titre = substr($titre, 0, LIMIT_CHAR);
            $titre .= '...';
        }
        

        if(!empty($titre)) {
            $result .= 'data-text="' . $titre . '" ';
        }
        $result .= '>Tweet</a>' .
        '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
        return $result;
    }
}