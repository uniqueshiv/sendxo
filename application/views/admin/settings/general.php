<section id="main-content">
    <section class="wrapper">
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel" style="overflow:hidden;">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> General Settings</h4>
                    <form class="form-horizontal style-form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="save" value="1">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Site name</label>
                            <div class="col-sm-10">
                                <input type="text" name="site_name" class="form-control" value="<?php echo $settings['site_name']; ?>">
                                <i>Your site name, Eg: Droppy</i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Site title</label>
                            <div class="col-sm-10">
                                <input type="text" name="site_title" class="form-control" value="<?php echo $settings['site_title']; ?>">
                                <i>Your site title, Eg: Droppy - Online file sharing (This will be shown in a browser tab)</i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Site description (Search engines)</label>
                            <div class="col-sm-10">
                                <input type="text" name="site_desc" class="form-control" value="<?php echo $settings['site_desc']; ?>">
                                <i>Description of your website</i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Site keywords (Search engines)</label>
                            <div class="col-sm-10">
                                <input type="text" name="site_keywords" class="form-control" value="<?php echo $settings['site_keywords']; ?>">
                                <i>Site keywords, separate them with a comma (Like this: uploader, files, transfer)</i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Name on zip file</label>
                            <div class="col-sm-10">
                                <input type="text" name="name_on_file" class="form-control" value="<?php echo $settings['name_on_file']; ?>">
                                <i>The name on the downloaded zip files (E.g. <u>droppy</u>-sg785ey.zip or <u>file</u>-82js87w.zip)</i> <p><b>WARNING:</b> By editing this name you won't be able to download old files anymore.</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Site url</label>
                            <div class="col-sm-10">
                                <input type="text" name="site_url" class="form-control" value="<?php echo $settings['site_url']; ?>">
                                <i>The url of your website</i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Logo path</label>
                            <div class="col-sm-10">
                                <input type="text" name="logo_path" class="form-control" value="<?php echo $settings['logo_path']; ?>">
                                <i>Path to your logo image</i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Favicon path</label>
                            <div class="col-sm-10">
                                <input type="text" name="favicon_path" class="form-control" value="<?php echo $settings['favicon_path']; ?>">
                                <i>Path to your favicon image</i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Lock site</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="lock_page" value="<?php echo $settings['lock_page'] ?>">
                                    <option value="false">Disable lock</option>
                                    <option value="both">Both</option>
                                    <option value="upload">Upload page</option>
                                    <option value="download">Download page</option>
                                </select>
                                <i>Select which part of the site you would like to have protected with a password.</i>
                            </div>
                        </div>
                        <script>$('select[name="lock_page"]').val("<?php echo $settings['lock_page'] ?>");</script>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Default share type</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="default_sharetype">
                                    <option value="mail">E-Mail</option>
                                    <option value="link">Link</option>
                                </select>
                                <i>The share type E-Mail or Link on page load</i>

                            </div>
                        </div>
                        <script>$('select[name="default_sharetype"]').val("<?php echo $settings['default_sharetype'] ?>");</script>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Password function enabled</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="password_enabled">
                                    <option value="true">Yes</option>
                                    <option value="false">No</option>
                                </select>
                                <i>Turns the password function on or off</i>
                            </div>
                        </div>
                        <script>$('select[name="password_enabled"]').val("<?php echo $settings['password_enabled'] ?>");</script>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Destruction default</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="default_destruct">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                <i>The destruction option in the upload settings section will automaticly select Yes or No</i>
                            </div>
                        </div>
                        <script>$('select[name="default_destruct"]').val("<?php echo $settings['default_destruct'] ?>");</script>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Default email to</label>
                            <div class="col-sm-10">
                                <input type="text" name="default_email_to" class="form-control" value="<?php echo $settings['default_email_to'] ?>">
                                <i>Default email where all uploads need to be send to (Leave empty to let users choose their own recipients)</i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Slide timer</label>
                            <div class="col-sm-10">
                                <input type="text" name="bg_timer" class="form-control" value="<?php echo $settings['bg_timer']; ?>">
                                <i>The time between every background image (Seconds) input 0 to disable this function</i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Expire time</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="expire">
                                    <option value="0">Disable</option>
                                    <optgroup label="Hours">
                                        <option value="3600">1 Hour</option>
                                        <option value="10800">3 Hours</option>
                                        <option value="18000">5 Hours</option>
                                        <option value="28800">8 Hours</option>
                                        <option value="36000">10 Hours</option>
                                        <option value="43200">12 Hours</option>
                                        <option value="50400">14 Hours</option>
                                        <option value="57600">16 Hours</option>
                                        <option value="64800">18 Hours</option>
                                        <option value="72000">20 Hours</option>
                                        <option value="79200">22 Hours</option>
                                    </optgroup>
                                    <optgroup label="Days">
                                        <option value="86400">1 Day</option>
                                        <option value="172800">2 Days</option>
                                        <option value="259200">3 Days</option>
                                        <option value="345600">4 Days</option>
                                        <option value="432000">5 Days</option>
                                        <option value="518400">6 Days</option>
                                    </optgroup>
                                    <optgroup label="Weeks">
                                        <option value="604800">1 Week</option>
                                        <option value="1209600">2 Weeks</option>
                                        <option value="1814400">3 Weeks</option>
                                    </optgroup>
                                    <optgroup label="Months">
                                        <option value="2592000">1 Month</option>
                                        <option value="5184000">2 Months</option>
                                        <option value="7776000">3 Months</option>
                                        <option value="10368000">4 Months</option>
                                        <option value="12960000">5 Months</option>
                                        <option value="15552000">6 Months</option>
                                        <option value="18144000">7 Months</option>
                                        <option value="20736000">8 Months</option>
                                        <option value="23328000">9 Months</option>
                                        <option value="25920000">10 Months</option>
                                        <option value="28512000">11 Months</option>
                                        <option value="31104000">12 Months</option>
                                    </optgroup>
                                </select>
                                <p><i>Time till a file gets destroyed</i></p>
                            </div>
                        </div>
                        <script>$('select[name="expire"]').val("<?php echo $settings['expire'] ?>");</script>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Max selected files</label>
                            <div class="col-sm-10">
                                <input type="number" name="max_files" class="form-control" value="<?php echo $settings['max_files']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Max upload size <b>(MB)</b></label>
                            <div class="col-sm-10">
                                <input type="number" name="max_size" class="form-control" value="<?php echo $settings['max_size']; ?>">
                                <i>Maximum upload size in MB</i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Max chunk size <b>(MB)</b></label>
                            <div class="col-sm-10">
                                <input type="number" name="max_chunk_size" class="form-control" value="<?php echo $settings['max_chunk_size']; ?>">
                                <i><b>Please do not change this if you don't know what you're doing</b>. Maximum chunk size in MB (Files are being uploaded in chunks (broken into pieces on the client computer and put back together on your web-server)), this value will define the maximum allowed size of each chunk. Suggested value is 1 MB.</i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Max file reports</label>
                            <div class="col-sm-10">
                                <input type="number" name="max_file_reports" class="form-control" value="<?php echo $settings['max_file_reports']; ?>">
                                <i>Amount of reports it takes before a file gets destroyed (Set 0 to disable)</i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Encrypt files (<a href="https://proxibolt.zendesk.com/hc/en-us/articles/115001511049" target="_blank" style="color: blue;">More info</a>)</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="encrypt_files">
                                    <option value="1">Enabled</option>
                                    <option value="0">Disabled</option>
                                </select>
                                <i><span style="color: red;">IMPORTANT !</span> you will need to have the PHP module " mcrypt " installed on your server. Files that are already on the server will be kept uncrypted only<br> new uploaded files will be encrypted, the uncrypted files will still be available for download. More information about the encryption feature can be found in </i><a href="https://proxibolt.zendesk.com/hc/en-us/articles/115001511049" target="_blank" style="color: blue;">this article</a>
                            </div>
                        </div>
                        <script>$('select[name="encrypt_files"]').val("<?php echo $settings['encrypt_files'] ?>");</script>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Blocked file types</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="blocked_types" style="width: 100%; height: 100px;"><?php echo $settings['blocked_types']; ?></textarea>
                                <i>Choose which file type(s) have to be blocked. (Split values with  a comma ',' and without any space between them, All file types can be found <a href="http://www.iana.org/assignments/media-types/media-types.xhtml">here</a>)</i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Upload directory</label>
                            <div class="col-sm-10">
                                <input type="text" name="upload_dir" class="form-control" value="<?php echo $settings['upload_dir'] ?>">
                                <i>Do not forget to add a "/" at the end</i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Timezone</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="timezone">
                                    <option value="">Server default</option>
                                    <option value="Pacific/Midway">(GMT-11:00) Midway Island, Samoa</option>
                                    <option value="Pacific/Midway">(GMT-11:00) Midway Island, Samoa</option>
                                    <option value="America/Adak">(GMT-10:00) Hawaii-Aleutian</option>
                                    <option value="Etc/GMT+10">(GMT-10:00) Hawaii</option>
                                    <option value="Pacific/Marquesas">(GMT-09:30) Marquesas Islands</option>
                                    <option value="Pacific/Gambier">(GMT-09:00) Gambier Islands</option>
                                    <option value="America/Anchorage">(GMT-09:00) Alaska</option>
                                    <option value="America/Ensenada">(GMT-08:00) Tijuana, Baja California</option>
                                    <option value="Etc/GMT+8">(GMT-08:00) Pitcairn Islands</option>
                                    <option value="America/Los_Angeles">(GMT-08:00) Pacific Time (US & Canada)</option>
                                    <option value="America/Denver">(GMT-07:00) Mountain Time (US & Canada)</option>
                                    <option value="America/Chihuahua">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                    <option value="America/Dawson_Creek">(GMT-07:00) Arizona</option>
                                    <option value="America/Belize">(GMT-06:00) Saskatchewan, Central America</option>
                                    <option value="America/Cancun">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                    <option value="Chile/EasterIsland">(GMT-06:00) Easter Island</option>
                                    <option value="America/Chicago">(GMT-06:00) Central Time (US & Canada)</option>
                                    <option value="America/New_York">(GMT-05:00) Eastern Time (US & Canada)</option>
                                    <option value="America/Havana">(GMT-05:00) Cuba</option>
                                    <option value="America/Bogota">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                    <option value="America/Caracas">(GMT-04:30) Caracas</option>
                                    <option value="America/Santiago">(GMT-04:00) Santiago</option>
                                    <option value="America/La_Paz">(GMT-04:00) La Paz</option>
                                    <option value="Atlantic/Stanley">(GMT-04:00) Faukland Islands</option>
                                    <option value="America/Campo_Grande">(GMT-04:00) Brazil</option>
                                    <option value="America/Goose_Bay">(GMT-04:00) Atlantic Time (Goose Bay)</option>
                                    <option value="America/Glace_Bay">(GMT-04:00) Atlantic Time (Canada)</option>
                                    <option value="America/St_Johns">(GMT-03:30) Newfoundland</option>
                                    <option value="America/Araguaina">(GMT-03:00) UTC-3</option>
                                    <option value="America/Montevideo">(GMT-03:00) Montevideo</option>
                                    <option value="America/Miquelon">(GMT-03:00) Miquelon, St. Pierre</option>
                                    <option value="America/Godthab">(GMT-03:00) Greenland</option>
                                    <option value="America/Argentina/Buenos_Aires">(GMT-03:00) Buenos Aires</option>
                                    <option value="America/Sao_Paulo">(GMT-03:00) Brasilia</option>
                                    <option value="America/Noronha">(GMT-02:00) Mid-Atlantic</option>
                                    <option value="Atlantic/Cape_Verde">(GMT-01:00) Cape Verde Is.</option>
                                    <option value="Atlantic/Azores">(GMT-01:00) Azores</option>
                                    <option value="Europe/Belfast">(GMT) Greenwich Mean Time : Belfast</option>
                                    <option value="Europe/Dublin">(GMT) Greenwich Mean Time : Dublin</option>
                                    <option value="Europe/Lisbon">(GMT) Greenwich Mean Time : Lisbon</option>
                                    <option value="Europe/London">(GMT) Greenwich Mean Time : London</option>
                                    <option value="Africa/Abidjan">(GMT) Monrovia, Reykjavik</option>
                                    <option value="Europe/Amsterdam">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                                    <option value="Europe/Belgrade">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                                    <option value="Europe/Brussels">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                                    <option value="Africa/Algiers">(GMT+01:00) West Central Africa</option>
                                    <option value="Africa/Windhoek">(GMT+01:00) Windhoek</option>
                                    <option value="Asia/Beirut">(GMT+02:00) Beirut</option>
                                    <option value="Africa/Cairo">(GMT+02:00) Cairo</option>
                                    <option value="Asia/Gaza">(GMT+02:00) Gaza</option>
                                    <option value="Africa/Blantyre">(GMT+02:00) Harare, Pretoria</option>
                                    <option value="Asia/Jerusalem">(GMT+02:00) Jerusalem</option>
                                    <option value="Europe/Minsk">(GMT+02:00) Minsk</option>
                                    <option value="Asia/Damascus">(GMT+02:00) Syria</option>
                                    <option value="Europe/Moscow">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                                    <option value="Africa/Addis_Ababa">(GMT+03:00) Nairobi</option>
                                    <option value="Asia/Tehran">(GMT+03:30) Tehran</option>
                                    <option value="Asia/Dubai">(GMT+04:00) Abu Dhabi, Muscat</option>
                                    <option value="Asia/Yerevan">(GMT+04:00) Yerevan</option>
                                    <option value="Asia/Kabul">(GMT+04:30) Kabul</option>
                                    <option value="Asia/Yekaterinburg">(GMT+05:00) Ekaterinburg</option>
                                    <option value="Asia/Tashkent">(GMT+05:00) Tashkent</option>
                                    <option value="Asia/Kolkata">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                    <option value="Asia/Katmandu">(GMT+05:45) Kathmandu</option>
                                    <option value="Asia/Dhaka">(GMT+06:00) Astana, Dhaka</option>
                                    <option value="Asia/Novosibirsk">(GMT+06:00) Novosibirsk</option>
                                    <option value="Asia/Rangoon">(GMT+06:30) Yangon (Rangoon)</option>
                                    <option value="Asia/Bangkok">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                                    <option value="Asia/Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                                    <option value="Asia/Hong_Kong">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                                    <option value="Asia/Irkutsk">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                    <option value="Australia/Perth">(GMT+08:00) Perth</option>
                                    <option value="Australia/Eucla">(GMT+08:45) Eucla</option>
                                    <option value="Asia/Tokyo">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                    <option value="Asia/Seoul">(GMT+09:00) Seoul</option>
                                    <option value="Asia/Yakutsk">(GMT+09:00) Yakutsk</option>
                                    <option value="Australia/Adelaide">(GMT+09:30) Adelaide</option>
                                    <option value="Australia/Darwin">(GMT+09:30) Darwin</option>
                                    <option value="Australia/Brisbane">(GMT+10:00) Brisbane</option>
                                    <option value="Australia/Hobart">(GMT+10:00) Hobart</option>
                                    <option value="Asia/Vladivostok">(GMT+10:00) Vladivostok</option>
                                    <option value="Australia/Lord_Howe">(GMT+10:30) Lord Howe Island</option>
                                    <option value="Etc/GMT-11">(GMT+11:00) Solomon Is., New Caledonia</option>
                                    <option value="Asia/Magadan">(GMT+11:00) Magadan</option>
                                    <option value="Pacific/Norfolk">(GMT+11:30) Norfolk Island</option>
                                    <option value="Asia/Anadyr">(GMT+12:00) Anadyr, Kamchatka</option>
                                    <option value="Pacific/Auckland">(GMT+12:00) Auckland, Wellington</option>
                                    <option value="Etc/GMT-12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                    <option value="Pacific/Chatham">(GMT+12:45) Chatham Islands</option>
                                    <option value="Pacific/Tongatapu">(GMT+13:00) Nuku'alofa</option>
                                    <option value="Pacific/Kiritimati">(GMT+14:00) Kiritimati</option>
                                </select>
                                <script>$('select[name="timezone"]').val("<?php echo $settings['timezone'] ?>");</script>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Google reCAPTCHA site key</label>
                            <div class="col-sm-10">
                                <input type="text" name="recaptcha_key" class="form-control" value="<?php echo $settings['recaptcha_key'] ?>">
                                <i>Required when the contact form is enabled</i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Google reCAPTCHA site secret</label>
                            <div class="col-sm-10">
                                <input type="text" name="recaptcha_secret" class="form-control" value="<?php echo $settings['recaptcha_secret'] ?>">
                                <i>Required when the contact form is enabled</i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Analytics code</label>
                            <div class="col-sm-10">
                                <textarea name="analytics" class="form-control" style="width: 100%; height: 200px;"><?php echo $settings['analytics'] ?></textarea>
                            </div>
                        </div>

                        <div style="float: right; padding-right: 5px;">
                            <button type="submit" class="btn btn-success" ><i class="fa fa-floppy-o"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div><!-- col-lg-12-->
        </div><!-- /row -->
    </section>
</section>