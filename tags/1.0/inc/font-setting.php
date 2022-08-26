<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="wrap">
    <h2 style="margin-bottom: 20px;">فونت پوسته</h2>
    <?php
    //show saved options message
    if($_REQUEST['settings-updated']) : ?>
        <br/><br/><div id="message" class="updated below-h2 notice is-dismissible"><p><?php _e('تنظیمات با موفقیت ذخیره شد.', 'awp'); ?></p><button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php _e('Close', 'awp'); ?></span></button></div>
    <?php endif; ?>
    <form method="post" action="options.php">
        <?php settings_fields('ariafont_font_settings'); ?>
        <?php $options = get_option('ariafont_font_settings'); ?>
        
        <hr/>
        <table class="form-table">
            <h3><?php _e('فونت پیش فرض قالب', 'awp'); ?></h3>
            <tr valign="top">
                <th scope="row"><?php _e('نام فونت', 'awp'); ?></th>
                <td>
                    <select name="ariafont_font_settings[bodyfontname]" id="ariafont_font_settings[bodyfontname]">
                        <option value=""><?php _e('هیچ کدام', 'awp'); ?></option>
                        <optgroup label="<?php _e('فونت های فارسی', 'awp'); ?>">
                            
                            <option <?php echo ($options['bodyfontname'] == "Yekan" ? "selected ":""); ?> value="Yekan">Yekan</option> 
                            <option <?php echo ($options['bodyfontname'] == "IranNastaliq" ? "selected ":""); ?> value="IranNastaliq">IranNastaliq</option> 
                            <option <?php echo ($options['bodyfontname'] == "droidarabicnaskh" ? "selected ":""); ?> value="droidarabicnaskh">Droid Arabic Naskh</option>
                            <option <?php echo ($options['bodyfontname'] == "droidarabickufi" ? "selected ":""); ?> value="droidarabickufi">Droid Arabic Kufi</option>
                                                    
                            <option <?php echo ($options['bodyfontname'] == "BBadr" ? "selected ":""); ?> value="BBadr">BBadr</option>
                            <option <?php echo ($options['bodyfontname'] == "BBaran" ? "selected ":""); ?> value="BBaran">BBaran</option>
                            <option <?php echo ($options['bodyfontname'] == "BBardiya" ? "selected ":""); ?> value="BBardiya">BBardiya</option>
                            <option <?php echo ($options['bodyfontname'] == "BCompset" ? "selected ":""); ?> value="BCompset">BCompset</option>
                            <option <?php echo ($options['bodyfontname'] == "BDavat" ? "selected ":""); ?> value="BDavat">BDavat</option>
                            <option <?php echo ($options['bodyfontname'] == "BElham" ? "selected ":""); ?> value="BElham">BElham</option>
                            <option <?php echo ($options['bodyfontname'] == "BEsfehanBold" ? "selected ":""); ?> value="BEsfehanBold">BEsfehanBold</option>
                            <option <?php echo ($options['bodyfontname'] == "BFantezy" ? "selected ":""); ?> value="BFantezy">BFantezy</option>
                            <option <?php echo ($options['bodyfontname'] == "BFarnaz" ? "selected ":""); ?> value="BFarnaz">BFarnaz</option>
                            <option <?php echo ($options['bodyfontname'] == "BFerdosi" ? "selected ":""); ?> value="BFerdosi">BFerdosi</option>
                            <option <?php echo ($options['bodyfontname'] == "BHamid" ? "selected ":""); ?> value="BHamid">BHamid</option>
                            <option <?php echo ($options['bodyfontname'] == "BHelal" ? "selected ":""); ?> value="BHelal">BHelal</option>
                            <option <?php echo ($options['bodyfontname'] == "BHoma" ? "selected ":""); ?> value="BHoma">BHoma</option>
                            <option <?php echo ($options['bodyfontname'] == "BJadidBold" ? "selected ":""); ?> value="BJadidBold">BJadidBold</option>
                            <option <?php echo ($options['bodyfontname'] == "BJalal" ? "selected ":""); ?> value="BJalal">BJalal</option>
                            <option <?php echo ($options['bodyfontname'] == "BKoodakBold" ? "selected ":""); ?> value="BKoodakBold">BKoodakBold</option>
                            <option <?php echo ($options['bodyfontname'] == "BKourosh" ? "selected ":""); ?> value="BKourosh">BKourosh</option>
                            <option <?php echo ($options['bodyfontname'] == "BLotus" ? "selected ":""); ?> value="BLotus">BLotus</option>
                            <option <?php echo ($options['bodyfontname'] == "BMahsa" ? "selected ":""); ?> value="BMahsa">BMahsa</option>
                            <option <?php echo ($options['bodyfontname'] == "BMehrBold" ? "selected ":""); ?> value="BMehrBold">BMehrBold</option>
                            <option <?php echo ($options['bodyfontname'] == "BMitra" ? "selected ":""); ?> value="BMitra">BMitra</option>
                            <option <?php echo ($options['bodyfontname'] == "BMorvarid" ? "selected ":""); ?> value="BMorvarid">BMorvarid</option>
                            <option <?php echo ($options['bodyfontname'] == "BNarm" ? "selected ":""); ?> value="BNarm">BNarm</option>
                            <option <?php echo ($options['bodyfontname'] == "BNasimBold" ? "selected ":""); ?> value="BNasimBold">BNasimBold</option>
                            <option <?php echo ($options['bodyfontname'] == "BNazanin" ? "selected ":""); ?> value="BNazanin">BNazanin</option>
                            <option <?php echo ($options['bodyfontname'] == "BRoya" ? "selected ":""); ?> value="BRoya">BRoya</option>
                            <option <?php echo ($options['bodyfontname'] == "BSetarehBold" ? "selected ":""); ?> value="BSetarehBold">BSetarehBold</option>
                            <option <?php echo ($options['bodyfontname'] == "BShiraz" ? "selected ":""); ?> value="BShiraz">BShiraz</option>
                            <option <?php echo ($options['bodyfontname'] == "BSinaBold" ? "selected ":""); ?> value="BSinaBold">BSinaBold</option>
                            <option <?php echo ($options['bodyfontname'] == "BTabassom" ? "selected ":""); ?> value="BTabassom">BTabassom</option>
                            <option <?php echo ($options['bodyfontname'] == "BTehran" ? "selected ":""); ?> value="BTehran">BTehran</option>
                            <option <?php echo ($options['bodyfontname'] == "BTitrBold" ? "selected ":""); ?> value="BTitrBold">BTitrBold</option>
                            <option <?php echo ($options['bodyfontname'] == "BTitrTGEBold" ? "selected ":""); ?> value="BTitrTGEBold">BTitrTGEBold</option>
                            <option <?php echo ($options['bodyfontname'] == "BTraffic" ? "selected ":""); ?> value="BTraffic">BTraffic</option>
                            <option <?php echo ($options['bodyfontname'] == "BVahidBold" ? "selected ":""); ?> value="BVahidBold">BVahidBold</option>
                            <option <?php echo ($options['bodyfontname'] == "BYas" ? "selected ":""); ?> value="BYas">BYas</option>
                            <option <?php echo ($options['bodyfontname'] == "BYekan" ? "selected ":""); ?> value="BYekan">BYekan</option>
                            <option <?php echo ($options['bodyfontname'] == "BZar" ? "selected ":""); ?> value="BZar">BZar</option>
                            <option <?php echo ($options['bodyfontname'] == "BZiba" ? "selected ":""); ?> value="BZiba">BZiba</option>
                        </optgroup>
                        
                    </select>
                    <p class="description"><?php _e('لطفا فونت خود را انتخاب کنید.', 'awp'); ?></p></td>
            </tr>
        </table>
        
        <hr/>
        <!-- Form Class -->
        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('ذخیره تغییرات', 'awp'); ?>" />
        </p>
    </form>
</div>
