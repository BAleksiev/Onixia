<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>        <div id="content">
            <div class="page">
                <h2 class="title">
                    <span style="padding-top: 10px; display: inline-block;"><?php echo translate('Settings');?></span>
                    <div class="subnav right">
                        <a href="" class="active"><span><?php echo translate('Main Settings');?></span></a>
                        <a href=""><span><?php echo translate('Secutiry');?></span></a>
                        <a href=""><span><?php echo translate('Account');?></span></a>
                    </div>
                </h2>
                <div class="panels">
                    <div class="main">
                        <div class="panel">
                            <div class="avatar" style="background: url(users/<?php echo $this->scope["user"]["id"];?>/<?php echo $this->scope["user"]["user"];?>.png) center center no-repeat;">
                                <div class="avatar-info">
                                    <label><?php echo $this->scope["user"]["user"];?></label>
                                </div>
                            </div>
                            <h2><?php echo translate('Avatar Change');?></h2>
                            <form action="settings.php" method="post" enctype="multipart/form-data">
                                <input type="file" name="avatar" class="inputavatar" />
                                <p>Аватарът трябва да е с максимална големина 50 kb.</p>
                                <input type="hidden" name="changeAvatar" value="1" />
                                <input type="submit" class="standart-button" value="<?php echo translate('Save avatar');?>"/>
                            </form>
                        </div>
                        <div class="panel">
                            <h2><?php echo translate('Sms Notification');?></h2>
                            <form action="settings.php" method="post">
                                <span>GSM (<?php echo translate('for');?> email2sms): </span>
                                <input type="text" name="gsm" style="width: 200px;" value="<?php if ((isset($this->scope["user"]["gsm"]) ? $this->scope["user"]["gsm"]:null)) {

echo $this->scope["user"]["gsm"];

}
else {
?>+359<?php 
}?>" />
                                <input type="hidden" name="changeGsm" value="1" />
                                <input type="submit" class="standart-button" value="<?php echo translate('Save');?>"/>
                            </form>
                        </div>
                        <div class="panel">
                            <h2><?php echo translate('Language');?></h2>
                            <form action="settings.php" method="post">
                                <span><?php echo translate('Choose language');?>: </span>
                                <select name="lang" style="width: 150px;">
                                    <option value="<?php echo $this->scope["user"]["lang"];?>"><?php echo $this->readVar("languages.".(isset($this->scope["user"]["lang"]) ? $this->scope["user"]["lang"]:null).".language");?></option>
                                    <?php 
$_fh0_data = (isset($this->scope["languages"]) ? $this->scope["languages"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['l'])
	{
/* -- foreach start output */
?>
                                    <?php if ((isset($this->scope["l"]["code"]) ? $this->scope["l"]["code"]:null) != (isset($this->scope["user"]["lang"]) ? $this->scope["user"]["lang"]:null)) {
?>
                                    <option value="<?php echo $this->scope["l"]["code"];?>"><?php echo $this->scope["l"]["language"];?></option>
                                    <?php 
}?>

                                    <?php 
/* -- foreach end output */
	}
}?>

                                </select>
                                <input type="hidden" name="language" value="1" />
                                <input type="submit" class="standart-button" value="<?php echo translate('Save');?>"/>
                            </form>
                        </div>
                    </div>
                    <div class="security">
                        <div class="panel">
                            <h2><?php echo translate('Password change');?></h2>
                            <form action="settings.php" method="post">
                                <span><?php echo translate('Old password');?>: </span>
                                <input type="password" name="oldPassword" />
                                <span><?php echo translate('Change password to');?>: </span>
                                <input type="password" name="newPassword" />
                                <input type="hidden" name="changePassword" value="1" />
                                <input type="submit" class="standart-button" value="<?php echo translate('Save');?>" style="float: none; margin-bottom: 0px;" />
                            </form>
                        </div>
                        <div class="panel">
                            <h2><?php echo translate('Email change');?></h2>
                            <form action="settings.php" method="post">
                                <span><?php echo translate('Old email');?>: </span>
                                <input type="text" name="oldEmail" />
                                <span><?php echo translate('New email');?>: </span>
                                <input type="text" name="newEmail" />
                                <span><?php echo translate('Password');?>: </span>
                                <input type="password" name="password" />
                                <input type="hidden" name="changeEmail" value="1" />
                                <input type="submit" class="standart-button" value="<?php echo translate('Save');?>" style="float: none; margin-bottom: 0px;" />
                            </form>
                        </div>
                        <div class="panel">
                            <h2 style="margin-bottom: 10px;"><?php echo translate('Username change');?></h2>
                            <form action="settings.php" method="post">
                                <label class="changeUsername"><?php echo translate('To change your username you will need to pay 100 Credits.');?></label>
                                <span><?php echo translate('New username');?>: </span>
                                <input type="text" name="newUsername" />
                                <span><?php echo translate('Password');?>: </span>
                                <input type="password" name="password" />
                                <input type="hidden" name="changeUsername" value="1" />
                                <input type="submit" class="standart-button" value="<?php echo translate('Save');?>" style="float: none; margin-bottom: 0px;" />
                            </form>
                        </div>
                        <div class="panel">
                            <h2 style="margin-bottom: 10px;"><?php echo translate('Delete account');?></h2>
                            <form action="settings.php" method="post">
                                <label class="deleteAcc"><?php echo translate('Attention ! Deletion is permanent !');?></label>
                                <a href="settings.php?act=delete-acc-code"><?php echo translate('I want to delete my account');?></a>
                                <span><?php echo translate('Deletion code');?>:</span>
                                <input type="text" name="deleteAcc" />
                                <span><?php echo translate('Password');?>:</span>
                                <input type="text" name="password" />
                                <input type="hidden" name="submitDelacc" value="1" />
                                <input type="submit" value="<?php echo translate('Delete');?>" class="standart-button" style="float: none; margin-bottom: 0; margin-top: 10px;" />
                            </form>
                        </div>
                    </div>
                    <div class="planets">
                        <div class="panel">
                            <h2><?php echo translate('Change planet name');?></h2>
                            <form action="settings.php" method="post">
                                <select name="planets">
                                    <?php 
$_fh1_data = (isset($this->scope["planets"]) ? $this->scope["planets"] : null);
if ($this->isArray($_fh1_data) === true)
{
	foreach ($_fh1_data as $this->scope['pl'])
	{
/* -- foreach start output */
?>
                                    <option value="<?php echo $this->scope["pl"]["id"];?>"><?php echo $this->scope["pl"]["name"];?> [<?php echo $this->scope["pl"]["c1"];?>:<?php echo $this->scope["pl"]["c2"];?>:<?php echo $this->scope["pl"]["c3"];?>]</option>
                                    <?php 
/* -- foreach end output */
	}
}?>

                                </select>
                                <input type="text" name="newPlanetname" placeholder="<?php echo translate('New name');?>"/>
                                <input type="hidden" name="changePlanetname" value="1" />
                                <input type="submit" value="<?php echo translate('Save');?>" class="standart-button" style="float: none; margin-bottom: 0;" />
                            </form>
                        </div>
                        <div class="panel">
                            <h2><?php echo translate('Deleting planets');?></h2>
                            <form action="settings.php" method="post">
                                <?php 
$_fh2_data = (isset($this->scope["planets"]) ? $this->scope["planets"] : null);
if ($this->isArray($_fh2_data) === true)
{
	foreach ($_fh2_data as $this->scope['pl'])
	{
/* -- foreach start output */
?>
                                <input type="radio" name="<?php echo $this->scope["pl"]["id"];?>" class="radio" /><?php echo $this->scope["pl"]["name"];?> [<?php echo $this->scope["pl"]["c1"];?>:<?php echo $this->scope["pl"]["c2"];?>:<?php echo $this->scope["pl"]["c3"];?>]
                                <?php 
/* -- foreach end output */
	}
}?><br/>
                                <span class="delpl-pass"><?php echo translate('Password');?>:</span>
                                <input type="text" name="password" class="celpl-pass"/>
                                <input type="hidden" name="submitDelpl" value="1" />
                                <input type="submit" value="<?php echo translate('Delete');?>" class="standart-button" style="float: none; margin-bottom: 0; margin-top: 20px;" />
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
        </script><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>