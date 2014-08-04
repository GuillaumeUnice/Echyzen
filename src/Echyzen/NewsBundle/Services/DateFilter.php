<?php

namespace Echyzen\NewsBundle\Services;

class DateFilter extends \Twig_Extension
{
	
	/**
	* Va parser l'ensemble du text
	*
	* @param string $text
	*/
	public function parse($text)
	{
		
		switch ($month) {
            case 1:
                return "Janvier";
            case 2:
                return "Fevrier";
            case 3:
                return "Mars";
            case 4:
                return "Avril";
            case 5:
                return "Mai";
            case 6:
                return "Juin";
            case 7:
                return "Juillet";
            case 8:
                return "Aout";
            case 9:
                return "Septembre";
            case 10:
                return "Octobre";
            case 11:
                return "Novembre";
            case 12:
                return "Decembre";
        }

	}
	
	/*
    * La méthode getName() identifie votre extension Twig, elle est obligatoire
    */
    public function getName()
    {
        return 'DateFilter';
    }


 public function getFilters()
    {
        return array(
            'datefilter' => new \Twig_Filter_Method($this, 'datefilter', array('is_safe' => array('html'))), 
        ); 
    }
}