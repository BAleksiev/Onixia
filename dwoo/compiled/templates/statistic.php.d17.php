<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>        <div id="content">
            <div class="page statistic">
                <table border="0" class="fixed">
                    <thead>
                        <tr class="head">
                            <td><?php echo translate('Resource');?></td>
                            <td class="cell70"><?php echo translate('metal');?></td>
                            <td class="cell70"><?php echo translate('crystals');?></td>
                            <td class="cell70"><?php echo translate('gas');?></td>
                            <td class="cell70"><?php echo translate('energy');?></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="active left"><?php echo translate('From metal mines');?></td>
                            <td class="active"><?php echo round((isset($this->scope["metalInc"]) ? $this->scope["metalInc"] : null));?></td>
                            <td></td>
                            <td></td>
                            <td class="active"><?php if ((isset($this->scope["metalEnergyUse"]) ? $this->scope["metalEnergyUse"] : null) != 0) {
?>-<?php 
}
echo round((isset($this->scope["metalEnergyUse"]) ? $this->scope["metalEnergyUse"] : null));?></td>
                        </tr>
                        <tr>
                            <td class="active left"><?php echo translate('From crystal mines');?></td>
                            <td></td>
                            <td class="active"><?php echo round((isset($this->scope["crystalInc"]) ? $this->scope["crystalInc"] : null));?></td>
                            <td></td>
                            <td class="active"><?php if ((isset($this->scope["crystalEnergyUse"]) ? $this->scope["crystalEnergyUse"] : null) != 0) {
?>-<?php 
}
echo round((isset($this->scope["crystalEnergyUse"]) ? $this->scope["crystalEnergyUse"] : null));?></td>
                        </tr>
                        <tr>
                            <td class="active left"><?php echo translate('From gas mines');?></td>
                            <td></td>
                            <td></td>
                            <td class="active"><?php echo round((isset($this->scope["gasInc"]) ? $this->scope["gasInc"] : null));?></td>
                            <td class="active"><?php if ((isset($this->scope["gasEnergyUse"]) ? $this->scope["gasEnergyUse"] : null) != 0) {
?>-<?php 
}
echo round((isset($this->scope["gasEnergyUse"]) ? $this->scope["gasEnergyUse"] : null));?></td>
                        </tr>
                        <tr>
                            <td class="active left"><?php echo translate('Used energy');?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="active"><?php echo round((isset($this->scope["usedEnergy"]) ? $this->scope["usedEnergy"] : null));?></td>
                        </tr>
                        <tr>
                            <td class="active left"><?php echo translate('Enrgy income');?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="active"><?php echo round((isset($this->scope["energyIncome"]) ? $this->scope["energyIncome"] : null));?></td>
                        </tr>
                        <tr>
                            <td class="active left"><?php echo translate('Enrgy from satelites');?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="active"></td>
                        </tr>
                        <tr>
                            <td class="active left"><?php echo translate('Bonus from robots');?></td>
                            <td class="active"></td>
                            <td class="active"></td>
                            <td class="active"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="active left"><?php echo translate('Bonus from energy systems');?></td>
                            <td class="active"><?php echo $this->scope["energySysBonus"];?></td>
                            <td class="active"><?php echo $this->scope["energySysBonus"];?></td>
                            <td class="active"><?php echo $this->scope["energySysBonus"];?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="active left"><?php echo translate('Total');?></td>
                            <td class="active"><?php echo round((isset($this->scope["metalTot"]) ? $this->scope["metalTot"] : null));?></td>
                            <td class="active"><?php echo round((isset($this->scope["crystalTot"]) ? $this->scope["crystalTot"] : null));?></td>
                            <td class="active"><?php echo round((isset($this->scope["gasTot"]) ? $this->scope["gasTot"] : null));?></td>
                            <td class="active"><?php echo round((isset($this->scope["freeEnergy"]) ? $this->scope["freeEnergy"] : null));?></td>
                        </tr>
                        <tr>
                            <td class="active left"><?php echo translate('Storage capacity');?></td>
                            <td class="active"><?php echo round((isset($this->scope["metalCap"]) ? $this->scope["metalCap"] : null));?></td>
                            <td class="active"><?php echo round((isset($this->scope["crystalCap"]) ? $this->scope["crystalCap"] : null));?></td>
                            <td class="active"><?php echo round((isset($this->scope["gasCap"]) ? $this->scope["gasCap"] : null));?></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <p><?php echo translate('* Total income values for Metal, Crystals and Gas you gain per hour.');?></p>
            </div>
        </div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>