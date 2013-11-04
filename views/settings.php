        <div id="content">
            <div class="page">
                <h2 class="title">
                    <span style="padding-top: 10px; display: inline-block;">{translate 'Settings'}</span>
                    <div class="subnav right">
                        <a href="" class="active"><span>{translate 'Main Settings'}</span></a>
                        <a href=""><span>{translate Secutiry}</span></a>
                        <a href=""><span>{translate Account}</span></a>
                    </div>
                </h2>
                <div class="panels">
                    <div class="main">
                        <div class="panel">
                            <div class="avatar" style="background: url(users/{$user.id}/{$user.user}.png) center center no-repeat;">
                                <div class="avatar-info">
                                    <label>{$user.user}</label>
                                </div>
                            </div>
                            <h2>{translate 'Avatar Change'}</h2>
                            <form action="settings.php" method="post" enctype="multipart/form-data">
                                <input type="file" name="avatar" class="inputavatar" />
                                <p>Аватарът трябва да е с максимална големина 50 kb.</p>
                                <input type="hidden" name="changeAvatar" value="1" />
                                <input type="submit" class="standart-button" value="{translate 'Save avatar'}"/>
                            </form>
                        </div>
                        <div class="panel">
                            <h2>{translate 'Sms Notification'}</h2>
                            <form action="settings.php" method="post">
                                <span>GSM ({translate for} email2sms): </span>
                                <input type="text" name="gsm" style="width: 200px;" value="{if $user.gsm}{$user.gsm}{else}+359{/if}" />
                                <input type="hidden" name="changeGsm" value="1" />
                                <input type="submit" class="standart-button" value="{translate 'Save'}"/>
                            </form>
                        </div>
                        <div class="panel">
                            <h2>{translate 'Language'}</h2>
                            <form action="settings.php" method="post">
                                <span>{translate 'Choose language'}: </span>
                                <select name="lang" style="width: 150px;">
                                    <option value="{$user.lang}">{$languages[$user.lang].language}</option>
                                    {foreach $languages l}
                                    {if $l.code != $user.lang}
                                    <option value="{$l.code}">{$l.language}</option>
                                    {/if}
                                    {/foreach}
                                </select>
                                <input type="hidden" name="language" value="1" />
                                <input type="submit" class="standart-button" value="{translate 'Save'}"/>
                            </form>
                        </div>
                    </div>
                    <div class="security">
                        <div class="panel">
                            <h2>{translate 'Password change'}</h2>
                            <form action="settings.php" method="post">
                                <span>{translate 'Old password'}: </span>
                                <input type="password" name="oldPassword" />
                                <span>{translate 'Change password to'}: </span>
                                <input type="password" name="newPassword" />
                                <input type="hidden" name="changePassword" value="1" />
                                <input type="submit" class="standart-button" value="{translate Save}" style="float: none; margin-bottom: 0px;" />
                            </form>
                        </div>
                        <div class="panel">
                            <h2>{translate 'Email change'}</h2>
                            <form action="settings.php" method="post">
                                <span>{translate 'Old email'}: </span>
                                <input type="text" name="oldEmail" />
                                <span>{translate 'New email'}: </span>
                                <input type="text" name="newEmail" />
                                <span>{translate Password}: </span>
                                <input type="password" name="password" />
                                <input type="hidden" name="changeEmail" value="1" />
                                <input type="submit" class="standart-button" value="{translate Save}" style="float: none; margin-bottom: 0px;" />
                            </form>
                        </div>
                        <div class="panel">
                            <h2 style="margin-bottom: 10px;">{translate 'Username change'}</h2>
                            <form action="settings.php" method="post">
                                <label class="changeUsername">{translate 'To change your username you will need to pay 100 Credits.'}</label>
                                <span>{translate 'New username'}: </span>
                                <input type="text" name="newUsername" />
                                <span>{translate Password}: </span>
                                <input type="password" name="password" />
                                <input type="hidden" name="changeUsername" value="1" />
                                <input type="submit" class="standart-button" value="{translate Save}" style="float: none; margin-bottom: 0px;" />
                            </form>
                        </div>
                        <div class="panel">
                            <h2 style="margin-bottom: 10px;">{translate 'Delete account'}</h2>
                            <form action="settings.php" method="post">
                                <label class="deleteAcc">{translate 'Attention ! Deletion is permanent !'}</label>
                                <a href="settings.php?act=delete-acc-code">{translate 'I want to delete my account'}</a>
                                <span>{translate 'Deletion code'}:</span>
                                <input type="text" name="deleteAcc" />
                                <span>{translate Password}:</span>
                                <input type="text" name="password" />
                                <input type="hidden" name="submitDelacc" value="1" />
                                <input type="submit" value="{translate Delete}" class="standart-button" style="float: none; margin-bottom: 0; margin-top: 10px;" />
                            </form>
                        </div>
                    </div>
                    <div class="planets">
                        <div class="panel">
                            <h2>{translate 'Change planet name'}</h2>
                            <form action="settings.php" method="post">
                                <select name="planets">
                                    {foreach $planets pl}
                                    <option value="{$pl.id}">{$pl.name} [{$pl.c1}:{$pl.c2}:{$pl.c3}]</option>
                                    {/foreach}
                                </select>
                                <input type="text" name="newPlanetname" placeholder="{translate 'New name'}"/>
                                <input type="hidden" name="changePlanetname" value="1" />
                                <input type="submit" value="{translate Save}" class="standart-button" style="float: none; margin-bottom: 0;" />
                            </form>
                        </div>
                        <div class="panel">
                            <h2>{translate 'Deleting planets'}</h2>
                            <form action="settings.php" method="post">
                                {foreach $planets pl}
                                <input type="radio" name="{$pl.id}" class="radio" />{$pl.name} [{$pl.c1}:{$pl.c2}:{$pl.c3}]
                                {/foreach}<br/>
                                <span class="delpl-pass">{translate Password}:</span>
                                <input type="text" name="password" class="celpl-pass"/>
                                <input type="hidden" name="submitDelpl" value="1" />
                                <input type="submit" value="{translate Delete}" class="standart-button" style="float: none; margin-bottom: 0; margin-top: 20px;" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="js/jquery.tools.min.js"></script>
        <script>
            $(function() {
                $(".subnav").tabs("div.panels > div");
            });
        </script>