<?php 

/**
* This class is in charge of translation in a php web application.
 * hosted in github 
 * By adonis97 <simoadonis@gmail.com>
 * Under LGPL licence. 
* HOW IT WORKS !!!!
 * 1- instanciate the class Traductor with a language name or not
 * 2- if there is no language name set in constructor first call setLanguage() methode to initialise a language pack the language pack is set in
 *      languages/{{language_file.php}}
 *      A language file as a array names $lang[] and the global structure is
 *      $lang['MACRO_NAME'] = 'VALUE_OF_MACRO'
 * 3- after that you can display a data just by using display() method like : display(MACRO_NAME);
* 
 * For better using you can store the translation details inside a session by doing
 * $_SESSION['VAR_NAME'] = $traduction->getLanguageData();
 * echo $_SESSION['VAR_NAME'][MACRO_NAME];
*/

class Traductor {

    /**
     * Will hold the a language data
     * @var array $lang
     */
    protected $lang = array();

    /**
     * Will hold the name of the current language 
     *
     * @var type string
     */
    protected $language;
    
    /**
     * Hold the path for finding languages files 
     * @var string The path of the directorie of languages
     */
    protected $LANG_PATH = 'languages/';
    
    /**
     * Contain the file extension 
     *
     * @var text 
     */
    protected $FILE_EXT = '.php';



    /**
     * Initialise the class
     * 
     * @param array $data 
     */
    private function hydrate($data = array()){
        if(isset($data['language'])){
            
            $this->setLanguage($data['language']);
        }
    }
    
    /**
     * This will be use to initialise a data of language
     * 
     * @param string $language_name
     */
    public function setLanguage($language_name){
        $this->language = $language_name;
        $complete_path = $this->LANG_PATH . $language_name.$this->FILE_EXT;
        if(!file_exists($complete_path)){
            echo 'Error : unable to find the specified language {'. $language_name.'} Located at ['. $complete_path .']';
            die();
        }
        //starting loading the language file. It will be a .php file
        @require_once $this->LANG_PATH . $language_name.$this->FILE_EXT;
        //this $lang is comming from the included file !!! and it data 
        // is saved to the lang attribute
        $this->lang = $lang;
    }
    
    /**
     * Is use for displaying and text from the language file
     * 
     * @param string $macro
     */
    public function display($macro){
        /**
         * Verifie first if any language has been set
         * If the macro exist inside the array we display it;
         */
        if($this->is_language_set() === FALSE){
            echo 'Error no language has been set; call setLanguage($lang_name) method before displaying macro';
            die();
        }
        if(array_key_exists($macro, $this->lang)){
            echo $this->lang[$macro];
            return $this;
        }else{
            echo 'Error unable to find the macro {'. $macro . '} in ['. $this->language .'] translation pack';
            die();
        }
        
    }
    
    /**
     * Is use for testing if a langage has been set by the user
     * 
     * @param string $lang_name
     */
    public function is_language_set(){
        if(empty($this->language)){
            return FALSE;
        }  else {
            return TRUE;
        }
    }
    
    
    /**
     * Is use for retrive the table of language pack
     * 
     * @return array table data of the traduction
     */
    public function getLanguageData(){
        if($this->is_language_set() === FALSE){
            echo 'Error no language has been set; call setLanguage($lang_name) method before displaying macro';
            die();
        }
        return $this->lang;
    }
    
    public function __construct($language = NULL) {
        $this->hydrate(array('language' => $language));
    }

}