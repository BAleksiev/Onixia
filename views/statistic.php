        <div id="content">
            <div class="page statistic">
                <h2 class="title">{translate 'Statistic'}</h2>
                <table class="standart">
                    <thead>
                        <tr class="head">
                            <td>{translate Resource}</td>
                            <td class="cell70">{translate metal}</td>
                            <td class="cell70">{translate crystals}</td>
                            <td class="cell70">{translate gas}</td>
                            <td class="cell70">{translate energy}</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="active res">{translate 'From metal mines'}</td>
                            <td class="active">{round $metalInc}</td>
                            <td></td>
                            <td></td>
                            <td class="active">{if $metalEnergyUse != 0}-{/if}{round $metalEnergyUse}</td>
                        </tr>
                        <tr>
                            <td class="active res">{translate 'From crystal mines'}</td>
                            <td></td>
                            <td class="active">{round $crystalInc}</td>
                            <td></td>
                            <td class="active">{if $crystalEnergyUse != 0}-{/if}{round $crystalEnergyUse}</td>
                        </tr>
                        <tr>
                            <td class="active res">{translate 'From gas mines'}</td>
                            <td></td>
                            <td></td>
                            <td class="active">{round $gasInc}</td>
                            <td class="active">{if $gasEnergyUse != 0}-{/if}{round $gasEnergyUse}</td>
                        </tr>
                        <tr>
                            <td class="active res">{translate 'Used energy'}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="active">{round $usedEnergy}</td>
                        </tr>
                        <tr>
                            <td class="active res">{translate 'Enrgy income'}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="active">{round $energyIncome}</td>
                        </tr>
                        <tr>
                            <td class="active res">{translate 'Enrgy from satelites'}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="active"></td>
                        </tr>
                        <tr>
                            <td class="active res">{translate 'Bonus from robots'}</td>
                            <td class="active"></td>
                            <td class="active"></td>
                            <td class="active"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="active res">{translate 'Bonus from energy systems'}</td>
                            <td class="active">{$energySysBonus}</td>
                            <td class="active">{$energySysBonus}</td>
                            <td class="active">{$energySysBonus}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="active res">{translate Total}</td>
                            <td class="active">{round $metalTot}</td>
                            <td class="active">{round $crystalTot}</td>
                            <td class="active">{round $gasTot}</td>
                            <td class="active">{round $freeEnergy}</td>
                        </tr>
                        <tr>
                            <td class="active res">{translate 'Storage capacity'}</td>
                            <td class="active">{round $metalCap}</td>
                            <td class="active">{round $crystalCap}</td>
                            <td class="active">{round $gasCap}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <p>{translate '* Total income values for Metal, Crystals and Gas you gain per hour.'}</p>
            </div>
        </div>