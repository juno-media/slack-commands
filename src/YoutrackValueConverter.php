<?php
namespace Juno;

use Ddeboer\DataImport\ValueConverter\ValueConverterInterface;

class YoutrackValueConverter implements ValueConverterInterface
{
    /**
     * Convert a value
     *
     * @param mixed $input Input value
     *
     * @return mixed
     */
    public function convert($input)
    {
        $input = str_getcsv($input, ' ', '"');
        if ($input[0] == "issue") {
            switch ($input[1]) {

                case "add":
                    $postData = array("project" => $input[2],
                                      "summary" => $input[3],
                                      "description" => $input[4]);

                    $input["endpoint"] = "youtrack/rest/issue?".http_build_query($postData);
                    $input["requestType"] = "PUT";
                    $input["commandType"] = $input[1];
                    break;

                case "delete":

                    $postData = array("issue" => $input[2]);

                    $input["endpoint"] = "issue?".http_build_query($postData);
                    $input["requestType"] = "DELETE";
                    $input["commandType"] = $input[1];
                    break;

                default:

                    $input["endpoint"] = null;
                    $input["requestType"] = null;
                    $input["commandType"] = null;
                    break;

            }
        }

        if ($input[0] === "login") {

            $username = $input[1];
            $password = $input[2];

            $postData = array("login" => $username,
                              "password" => $password);

            $input["endpoint"] = "youtrack/rest/user/login?".http_build_query($postData);
            $input["requestType"] = "POST";
            $input["commandType"] = "login";

        }
        return $input;
    }

}