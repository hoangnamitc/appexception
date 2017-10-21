<?php
    // namespace app\core;
    use \Exception;

    class AppException extends Exception{
        function __construct($message, $code=null) {
            set_exception_handler([$this, 'error_handle']);
            parent::__construct($message, $code);
        }

        public function error_handle($e) {
            echo "
                <h1 style=\"color:red;\">
                    {$e->getMessage()} - ({$e->getCode()})
                </h1>
                
                <h2 style=\"color:blue;\">
                    {$e->getFile()} - Line: {$e->getLine()}
                </h2>
                
                <br/><hr />

                <table border=\"1\" cellpadding=\"15\" style=\"
                    display:table;
                    margin:auto;
                    border-color: #CCC;
                    border-spacing: 0;
                \">
                    <tr style=\"background:#FF0;text-transform:uppercase;font-weight:bold;color:green;\">
                        <td align=\"center\">STT</td>
                        <td align=\"center\">File</td>
                        <td align=\"center\">Line</td>
                        <td align=\"center\">Class</td>
                        <td align=\"center\">Function</td>
                    </tr>
            ";
            $i = 1;
            foreach($e->getTrace() as $trace) {

                if( ! isset($trace['file']) )
                    continue;
                
                echo '
                    <tr>
                        <td align="center">
                            '.$i++.'
                        </td>
                    
                        <td>';
                            echo isset($trace['file']) ? $trace['file'] : null;
                        echo '
                        </td>
                        
                        <td align="center">';
                            echo isset($trace['line']) ? $trace['line'] : null;
                        echo '
                        </td>
                        
                        <td>';
                            echo isset($trace['class']) ? $trace['class'] : null;
                        echo '
                        </td>

                        <td>';
                            echo isset($trace['function']) ? $trace['function'] : null;
                        echo '
                        </td>

                    </tr>
                ';
            }
            echo "</table>";
        }
    }