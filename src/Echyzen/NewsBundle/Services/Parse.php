<?php

namespace Echyzen\NewsBundle\Services;

class Parse extends \Twig_Extension
{

	protected $bbcodeToHtml;
	public function __construct($bbcodeToHtml)
    {
        $this->bbcodeToHtml  = $bbcodeToHtml;
    }
	
	/**
	* Va parser l'ensemble du text
	*
	* @param string $text
	*/
	public function parse($text)
	{
		//foreach ($this->test as $value){
		foreach($this->bbcodeToHtml as $key => $value) {
			//$text = preg_replace('/<' . $value . '>(.*)<\/'. $value . '>/si', '<b>$1</b>', $text);
			$text = preg_replace('/<' . $key . '>(.*)<\/'. $key . '>/siU', '<' . $value . '>$1</' . $value . '>', $text);


			//$text .= $value;
		}
		
		
		return $text;

	}
	
	/*
    * La méthode getName() identifie votre extension Twig, elle est obligatoire
    */
    public function getName()
    {
        return 'Parse';
    }


 public function getFilters()
    {
        return array(
            'parse' => new \Twig_Filter_Method($this, 'parse', array('is_safe' => array('html'))), 
        ); 
    }
}