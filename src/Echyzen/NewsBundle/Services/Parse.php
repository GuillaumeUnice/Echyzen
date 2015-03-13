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

			//$text = preg_replace('/<' . $key . '>(.*)<\/'. $key . '>/si', '<strong>$1</strong>', $text);
			//$text = preg_replace('/\[' . $key . '\](.*)\[\/'. $key . '\]/siU', '<' . $value . '>$1</' . $value . '>', $text);
			//$text = 'lol';

			//$text .= $value;
		}
		
		//return $text;




		$text = trim($text);
        $text = strip_tags($text);
 
        $text = preg_replace_callback('/\[code\](.*?)\[\/code\]/ms', "self::escape", $text);
     	
        // BBCode to find...
        $in = array(    '/\[b\](.*?)\[\/b\]/ms',  
                        '/\[i\](.*?)\[\/i\]/ms',
                        '/\[u\](.*?)\[\/u\]/ms',
                        '/\[img\](.*?)\[\/img\]/ms',
                        '/\[email\](.*?)\[\/email\]/ms',
                        '/\[url\="?(.*?)"?\](.*?)\[\/url\]/ms',
                        '/\[size\="?(.*?)"?\](.*?)\[\/size\]/ms',
                        '/\[color\="?(.*?)"?\](.*?)\[\/color\]/ms',
                        '/\[quote](.*?)\[\/quote\]/ms',
                        '/\[list\=(.*?)\](.*?)\[\/list\]/ms',
                        '/\[list\](.*?)\[\/list\]/ms',
                        '/\[\*\]\s?(.*?)\n/ms'
        );
 
        // And replace them by...
        $out = array(   '<strong>\1</strong>',
                        '<em>\1</em>',
                        '<u>\1</u>',
                        '<img src="\1" alt="\1" />',
                        '<a href="mailto:\1">\1</a>',
                        '<a href="\1">\2</a>',
                        '<span style="font-size:\1%">\2</span>',
                        '<span style="color:\1">\2</span>',
                        '<blockquote>\1</blockquote>',
                        '<ol start="\1">\2</ol>',
                        '<ul>\1</ul>',
                        '<li>\1</li>'
        );

        $text = preg_replace($in, $out, $text);
         
        // paragraphs
        $text = str_replace("\r", "", $text);
        $text = "<p>".preg_replace("/(\n){2,}/", "</p><p>", $text)."</p>";
        $text = nl2br($text);
     
        // clean some tags to remain strict
        // not very elegant, but it works. No time to do better <img src="../../bundles/tinymce/vendor/tiny_mce/plugins/emotions/img/clin.png" title=";)" alt=";)">
        /* TODO je ne sais pas a quoi cela sert de la redéfinir peut être callback quelques part :D
        if (!function_exists('removeBr')) {
            function removeBr($s) {
                return str_replace("<br />", "", $s[0]);
            }
        }*/
 
        $text = preg_replace_callback('/<pre>(.*?)<\/pre>/ms', "self::removeBr", $text);
        $text = preg_replace('/<p><pre>(.*?)<\/pre><\/p>/ms', "<pre>\\1</pre>", $text);
     
        $text = preg_replace_callback('/<ul>(.*?)<\/ul>/ms', "self::removeBr", $text);
        $text = preg_replace('/<p><ul>(.*?)<\/ul><\/p>/ms', "<ul>\\1</ul>", $text);

        return $text;
	}
	private function escape($s) {
        global $text;
        $text = strip_tags($text);
        $code = $s[1];
        $code = htmlspecialchars($code);
        $code = str_replace("[", "&#91;", $code);
        $code = str_replace("]", "&#93;", $code);
        return '<pre><code>'.$code.'</code></pre>';
    }
 
    private function removeBr($s) {
        return str_replace("<br />", "", $s[0]);
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