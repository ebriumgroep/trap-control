var trapArray = new Array();            
                function ValidateAndAddTrap(){
                        if(document.getElementById("deviceID").value == "")
                        {
                                alert("Please enter device ID");
                                return false
                        }
                        var trapType = document.getElementById("trap_type");
                        var traptype_Value = trapType.options[trapType.selectedIndex].text;
                        var upload = document.getElementById("upload_interval");
                        var upload_value = upload.options[upload.selectedIndex].text;
                        var deviceID = document.getElementById("deviceID").value;
                        trapArray[trapArray.length] = new Array(traptype_Value,deviceID,upload_value);
                        return true;
                        
                }