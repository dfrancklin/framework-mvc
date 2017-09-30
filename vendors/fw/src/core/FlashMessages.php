<?php

namespace FW\Core;

class FlashMessages {

	private static $instance;

    const INFO = 'i';
    const SUCCESS = 's';
    const WARNING = 'w';
    const ERROR = 'e';

    const defaultType = self::INFO;

    protected $msgTypes = [
        self::ERROR   => 'error',
        self::WARNING => 'warning', 
        self::SUCCESS => 'success', 
        self::INFO    => 'info', 
    ];
    
    protected $msgWrapper = "<div class='%s'>%s</div>\n"; 
    
    protected $msgBefore = '';  
    protected $msgAfter  = ''; 
    
    protected $closeBtn  = '<button type="button" class="close" 
                                data-dismiss="alert" 
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>';
    
    protected $stickyCssClass = 'sticky';
    protected $msgCssClass = 'alert dismissable';
    protected $cssClassMap = [ 
        self::INFO    => 'alert-info',
        self::SUCCESS => 'alert-success',
        self::WARNING => 'alert-warning',
        self::ERROR   => 'alert-danger',
    ];
	
	private $appId;
	
	private $id = 'flash-messages';
    
	protected function __construct() {
       	$this->appId = Config::getInstance()->get('app-id');
        
        if (!array_key_exists($this->id, $_SESSION[$this->appId])){
			$_SESSION[$this->appId][$this->id] = [];
		}
    }
	
	public static function getInstance() : self {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

    public function info($message, $redirectUrl=null, $sticky=false) {
        return $this->add($message, self::INFO, $redirectUrl, $sticky);
    }

    public function success($message, $redirectUrl=null, $sticky=false) {
        return $this->add($message, self::SUCCESS, $redirectUrl, $sticky);
    }

    public function warning($message, $redirectUrl=null, $sticky=false) {
        return $this->add($message, self::WARNING, $redirectUrl, $sticky);
    }

	public function error($message, $redirectUrl=null, $sticky=false) {
        return $this->add($message, self::ERROR, $redirectUrl, $sticky);
    }

	public function sticky($message=true, $redirectUrl=null, $type=self::defaultType) {   
        return $this->add($message, $type, $redirectUrl, true);
    }

    public function add($message, $type=self::defaultType, $redirectUrl=null, $sticky=false) {
        if (!isset($message[0])) {
			return false;
		}

        if (strlen(trim($type)) > 1) {
			$type = strtolower($type[0]);
		}

		if (!array_key_exists($type, $this->msgTypes)) {
			$type = $this->defaultType;
		}

        if (!array_key_exists($type, $_SESSION[$this->appId][$this->id])) {
			$_SESSION[$this->appId][$this->id][$type] = array();
		}

        $_SESSION[$this->appId][$this->id][$type][] = [
			'sticky' => $sticky, 
			'message' => $message
		];
        
        return $this;
    }

    public function display($types=null, $print=true) 
    {
        if (!isset($_SESSION[$this->appId][$this->id])) return false;
        
        $output = '';
        // Print all the message types
        if (is_null($types) || !$types || (is_array($types) && empty($types)) ) {
            $types = array_keys($this->msgTypes);
        // Print multiple message types (as defined by an array)
        } elseif (is_array($types) && !empty($types)) {
            $theTypes = $types;
            $types = [];
            foreach($theTypes as $type) {
                $types[] = strtolower($type[0]);
            }
        // Print only a single message type
        } else {
            $types = [strtolower($types[0])];
        }
        // Retrieve and format the messages, then remove them from session data
        foreach ($types as $type) {
            if (!isset($_SESSION[$this->appId][$this->id][$type]) || empty($_SESSION[$this->appId][$this->id][$type]) ) continue;
            foreach( $_SESSION[$this->appId][$this->id][$type] as $msgData ) {
                $output .= $this->formatMessage($msgData, $type);
            }
            $this->clear($type);            
        }
        
        // Print everything to the screen (or return the data)
        if ($print) { 
            echo $output; 
        } else { 
            return $output; 
        }
    }
        /**
     * See if there are any queued error messages
     * 
     * @return boolean 
     * 
     */
    public function hasErrors()
    {
        return empty($_SESSION[$this->appId][$this->id][self::ERROR]) ? false : true;  
    }
    /**
     * See if there are any queued message
     * 
     * @param  string  $type  The $msgType
     * @return boolean
     * 
     */
    public function hasMessages($type=null) {
        if (!is_null($type)) {
            if (!empty($_SESSION[$this->appId][$this->id][$type])) return $_SESSION[$this->appId][$this->id][$type]; 
        } else {
            foreach (array_keys($this->msgTypes) as $type) {
                if (isset($_SESSION[$this->appId][$this->id][$type]) && !empty($_SESSION[$this->appId][$this->id][$type])) return $_SESSION[$this->appId][$this->id][$type]; 
            }
        }
        return false;
    }
    /**
     * Format a message
     * 
     * @param  array  $msgDataArray   Array of message data
     * @param  string $type           The $msgType
     * @return string                 The formatted message
     * 
     */
    protected function formatMessage($msgDataArray, $type)
    {
     
        $msgType = isset($this->msgTypes[$type]) ? $type : $this->defaultType;
        $cssClass = $this->msgCssClass . ' ' . $this->cssClassMap[$type];
        $msgBefore = $this->msgBefore;
        // If sticky then append the sticky CSS class
        if ($msgDataArray['sticky']) {
            $cssClass .= ' ' . $this->stickyCssClass;
        // If it's not sticky then add the close button
        } else {
            $msgBefore = $this->closeBtn . $msgBefore;
        }
        // Wrap the message if necessary
        $formattedMessage = $msgBefore . $msgDataArray['message'] . $this->msgAfter; 
        return sprintf(
            $this->msgWrapper, 
            $cssClass, 
            $formattedMessage
        );
    }

    /**
     * Clear the messages from the session data
     * 
     * @param  mixed  $types  (array) Clear all of the message types in array
     *                        (string)  Only clear the one given message type
     * @return object 
     * 
     */
    protected function clear($types=[]) 
    { 
        if ((is_array($types) && empty($types)) || is_null($types) || !$types) {
            unset($_SESSION[$this->appId][$this->id]);
        } elseif (!is_array($types)) {
            $types = [$types];
        }
        foreach ($types as $type) {
            unset($_SESSION[$this->appId][$this->id][$type]);
        }
        return $this;
    }
    
    /**
     * Set the HTML that each message is wrapped in
     * 
     * @param string $msgWrapper The HTML that each message is wrapped in. 
     *                           Note: Two placeholders (%s) are expected.  
     *                           The first is the $msgCssClass,
     *                           The second is the message text.
     * @return object
     * 
     */
    public function setMsgWrapper($msgWrapper='')
    {
        $this->msgWrapper = $msgWrapper;
        return $this;
    }
    /**
     * Prepend string to the message (inside of the message wrapper)
     * 
     * @param string $msgBefore string to prepend to the message
     * @return object
     * 
     */
    public function setMsgBefore($msgBefore='')
    {
        $this->msgBefore = $msgBefore;
        return $this;
    }
    /**
     * Append string to the message (inside of the message wrapper)
     * 
     * @param string $msgAfter string to append to the message
     * @return object
     * 
     */
    public function setMsgAfter($msgAfter='')
    {
        $this->msgAfter = $msgAfter;
        return $this;
    }
    /**
     * Set the HTML for the close button
     * 
     * @param string  $closeBtn  HTML to use for the close button
     * @return object
     * 
     */
    public function setCloseBtn($closeBtn='')
    {
        $this->closeBtn = $closeBtn;
        return $this;
    }
    /**
     * Set the CSS class for sticky notes
     * 
     * @param string  $stickyCssClass  the CSS class to use for sticky messages
     * @return object
     * 
     */
    public function setStickyCssClass($stickyCssClass='')
    {
        $this->stickyCssClass = $stickyCssClass;
        return $this;
    }
    /**
     * Set the CSS class for messages
     * 
     * @param string $msgCssClass The CSS class to use for messages
     * 
     * @return object 
     * 
     */
    public function setMsgCssClass($msgCssClass='')
    {
        $this->msgCssClass = $msgCssClass;
        return $this;
    }
    /**
     * Set the CSS classes for message types
     *
     * @param mixed  $msgType    (string) The message type 
     *                           (array) key/value pairs for the class map
     * @param mixed  $cssClass   (string) the CSS class to use
     *                           (null) not used when $msgType is an array
     * @return object 
     * 
     */
    public function setCssClassMap($msgType, $cssClass=null) 
    {
        if (!is_array($msgType) ) {
            // Make sure there's a CSS class set
            if (is_null($cssClass)) return $this;
            $msgType = [$msgType => $cssClass];
        }
        foreach ($msgType as $type => $cssClass) {
            $this->cssClassMap[$type] = $cssClass;
        }
        return $this;
    }
}