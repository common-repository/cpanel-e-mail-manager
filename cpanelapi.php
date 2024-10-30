<?php

if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

class cpanel_email_manager_api {

    private $serverip = '127.0.0.1';
    private $usessl = 1;

	function __construct($serverip, $usessl) {
		$this->serverip = $serverip;
		$this->usessl = $usessl;
	}

    function addremotedbhost($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'MysqlFE';
        $args['cpanel_jsonapi_func'] = 'authorizehost';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "The remote database access host was successfully added.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function deleteremotedbhost($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'MysqlFE';
        $args['cpanel_jsonapi_func'] = 'deauthorizehost';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "The remote database access host was successfully removed.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function createdb($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'MysqlFE';
        $args['cpanel_jsonapi_func'] = 'createdb';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "The database was successfully created.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function createdbuser($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'MysqlFE';
        $args['cpanel_jsonapi_func'] = 'createdbuser';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "The database user was successfully created.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function removedbuser($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'MysqlFE';
        $args['cpanel_jsonapi_func'] = 'deletedbuser';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "The database user was successfully removed.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function removedb($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'MysqlFE';
        $args['cpanel_jsonapi_func'] = 'deletedb';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "The database was successfully removed.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function assigndbtouser($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'MysqlFE';
        $args['cpanel_jsonapi_func'] = 'setdbuserprivileges';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "The database privileges were successfully assigned.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function createparkeddomain($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'Park';
        $args['cpanel_jsonapi_func'] = 'park';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "The domain has been successfully parked.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function createsubdomain($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'SubDomain';
        $args['cpanel_jsonapi_func'] = 'addsubdomain';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0]->reason)) {
                    $return["status"] = 1;
                    $return["response"] = $result[0]->reason;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function extractzip($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'Fileman';
        $args['cpanel_jsonapi_func'] = 'fileop';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "The archive file was successfully extracted.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function createarchive($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'Fileman';
        $args['cpanel_jsonapi_func'] = 'fileop';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "The archive file was successfully created.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function movefile($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'Fileman';
        $args['cpanel_jsonapi_func'] = 'fileop';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "The file was successfully moved.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function renamefile($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'Fileman';
        $args['cpanel_jsonapi_func'] = 'fileop';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "The file was successfully renamed.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function deletefile($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'Fileman';
        $args['cpanel_jsonapi_func'] = 'fileop';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "The file was successfully removed.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function deletefolder($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'Fileman';
        $args['cpanel_jsonapi_func'] = 'fileop';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "The folder was successfully removed.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function createfolder($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'Fileman';
        $args['cpanel_jsonapi_func'] = 'mkdir';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "The folder was successfully created.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function chmodobject($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'Fileman';
        $args['cpanel_jsonapi_func'] = 'fileop';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "Permissions for the file or folder have been successfully updated.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function getdomain($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'DomainLookup';
        $args['cpanel_jsonapi_func'] = 'getmaindomain';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0]->main_domain)) {
                    $return["status"] = 1;
                    $return["response"] = $result[0]->main_domain;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function gethomedir($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'DomainLookup';
        $args['cpanel_jsonapi_func'] = 'getdocroot';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0]->docroot)) {
                    $return["status"] = 1;
                    $return["response"] = $result[0]->docroot;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function getdomainip($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'ZoneEdit';
        $args['cpanel_jsonapi_func'] = 'fetchzone';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    foreach ($result[0]->record as $dnsvalue) {
                        if ($dnsvalue->type == "A") {
                            $return["response"] = $dnsvalue->address;
                        }
                    }
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function listcronjobs($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'Cron';
        $args['cpanel_jsonapi_func'] = 'listcron';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = $result;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function getdiskusage($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'DiskUsage';
        $args['cpanel_jsonapi_func'] = 'fetchdiskusage';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = $result[0];
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function addcronjob($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'Cron';
        $args['cpanel_jsonapi_func'] = 'add_line';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "The cron job was succecssfully added.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function removecronjob($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'Cron';
        $args['cpanel_jsonapi_func'] = 'remove_line';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "The cron job was succecssfully removed.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function createemailaccount($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'Email';
        $args['cpanel_jsonapi_func'] = 'addpop';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "The e-mail account was successfully created.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function removeemailaccount($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'Email';
        $args['cpanel_jsonapi_func'] = 'delpop';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "The e-mail account was successfully removed.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function changeemailpw($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'Email';
        $args['cpanel_jsonapi_func'] = 'passwdpop';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "The e-mail account password was successfully changed.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function listemaildomains($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'Email';
        $args['cpanel_jsonapi_func'] = 'listmaildomains';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = $result;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function getemailaccountdata($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'Email';
        $args['cpanel_jsonapi_func'] = 'listpopswithdisk';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = $result[0];
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function getemailaccountlist($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'Email';
        $args['cpanel_jsonapi_func'] = 'listpopswithdisk';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = $result;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function listemailaccountstats($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'StatsBar';
        $args['cpanel_jsonapi_func'] = 'stat';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = $result[0];
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function createemaillist($settings, $args = array()) {
        //UAPI
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/execute/Email/add_list";
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->errors)) {
            $return["status"] = 0;
            $return["response"] = implode(" ", $json_decode->errors);
        } else {
            if (!empty($json_decode->messages)) {
                $result = implode(" ", $json_decode->messages);
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                $return["status"] = 1;
                $return["response"] = $result;
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function removeemaillist($settings, $args = array()) {
        //UAPI
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/execute/Email/delete_list";
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->errors)) {
            $return["status"] = 0;
            $return["response"] = implode(" ", $json_decode->errors);
        } else {
            if (!empty($json_decode->messages)) {
                $result = implode(" ", $json_decode->messages);
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                $return["status"] = 1;
                $return["response"] = $result;
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function changeemailquota($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'Email';
        $args['cpanel_jsonapi_func'] = 'editquota';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = "The e-mail account quota was successfully changed.";
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function listemailmailinglists($settings, $args = array()) {
        //CPANEL API 2
        if ($this->usessl) {
            $prefix = "https://";            
            $port = 2083;
        } else {
            $prefix = "http://";            
            $port = 2082;
        }
        $url = $prefix . $this->serverip . ":" . $port . "/json-api/cpanel";
        $args['api.version'] = 1;
        $args['cpanel_jsonapi_module'] = 'Email';
        $args['cpanel_jsonapi_func'] = 'listlists';
        $args['cpanel_jsonapi_apiversion'] = 2;
        $postdata = http_build_query($args, '', '&');
        $output = $this->call_api($url, $postdata, "cpanel", strtolower($settings["username"]), $settings["password"]);
        $json_decode = json_decode($output);

        //USE TO DEBUG OUTPUT
        //echo $output;
        //print_r($json_decode);

        //ASSIGN OUPTPUT VALIES
        if (!empty($json_decode->error)) {
            $return["status"] = 0;
            $return["response"] = $json_decode->error;
        } else {
            if (!empty($json_decode->cpanelresult->error)) {
                $return["status"] = 0;
                $return["response"] = $json_decode->cpanelresult->error;
            } elseif (!empty($json_decode->cpanelresult->data)) {
                $result = $json_decode->cpanelresult->data;
                //CUSTOMIZE OUTPUT FOR EXPECTED RESPONSE
                if (!empty($result[0])) {
                    $return["status"] = 1;
                    $return["response"] = $result;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            } else {
                if (!empty($output)) {
                    $return["status"] = 0;
                    $return["response"] = $output;
                } else {
                    $return["status"] = 0;
                    $return["response"] = "A valid response was not received from the cPanel server.";
                }
            }
        }
        return $return;
    }

    function call_api($url, $postdata, $authtype, $username, $password, $apitoken = null) {
        if ($authtype == "cpanel") {
            $authstr = 'Authorization: Basic ' . base64_encode($username . ':' . $password);
        } else {
            if (!empty($apitoken)) {
                $authstr = 'Authorization: WHM ' . $username . ':' . preg_replace("/(\n|\r|\s)/", '', $apitoken);
            } else {
                $authstr = 'Authorization: Basic ' . base64_encode($username . ':' . $password);
            }
        }
        ob_start();  
        $out = fopen('php://output', 'w');
		$ch = curl_init();
        $header[0] = $authstr . "\r\nContent-Type: application/x-www-form-urlencoded\r\nContent-Length: " . strlen($postdata) . "\r\n\r\n" . $postdata;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSH_AUTH_TYPES, CURLSSH_AUTH_ANY);
		curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_ALL);
        curl_setopt($ch, CURLOPT_VERBOSE, true);  
        curl_setopt($ch, CURLOPT_STDERR, $out);  
        curl_setopt($ch, CURLOPT_BUFFERSIZE, 131072);
		$data = curl_exec($ch);
        $error_no = curl_errno($ch);
        $last_error = curl_error($ch);
        fclose($out);  
        $debug = ob_get_clean();
        if ($data == false) {
            if (!empty($last_error)) {
    			return $last_error . " (" . $error_no . ")";
            }  elseif (!empty($out)) {
                return $out;
            } else {
                return "An unknown error occurred while trying to connect to the remote cPanel server.";
            }
        }
		curl_close($ch);
        return $data;
    }
}