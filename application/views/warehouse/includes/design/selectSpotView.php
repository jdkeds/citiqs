<style>
.elHover:hover {
    background-color: red !important;
    
}

.elHover {
    background-color: red !important;
    
}

</style>
<fieldset id="selectSpotView" class="hideFieldsets">
    <legend>Select spot view</legend>
    <div class="form-group col-sm-12">
        <label style="display:block;">
            Background color:
            <input
                data-jscolor=""
				style="border-radius: 50px"
                class="form-control"
                name="selectSpot[id][selectSpotContainer][background-color]"
                data-css-selector="id"
                data-css-selector-value="selectSpotContainer"
                data-css-property="background-color"
                onfocus="styleELements(this)"
                oninput="styleELements(this)"
                <?php if ( isset($design['selectSpot']['id']['selectSpotContainer']['background-color']) ) { ?>
                value = "<?php echo $design['selectSpot']['id']['selectSpotContainer']['background-color']?>"
                data-value="1"
                <?php } ?>
            />
        </label>
    </div>
    <div class="form-group col-sm-12">
        <label style="display:block;">
            Hover background color:
            <input
                data-jscolor=""
				style="border-radius: 50px"
                class="form-control"
                name="hover[select__list__item]"
                data-css-selector="id"
                data-css-selector-value="select__list__item"
                data-css-property="background-color"
                onfocus="hoverStyle(this)"
                oninput="hoverStyle(this)"
                <?php if ( isset($design['hover']['select__list__item']) ) { ?>
                value = "<?php echo $design['hover']['select__list__item']?>"
                data-value="1"
                <?php } ?>
            />
            </label>
    </div>
    <div class="form-group col-sm-12">
        <label style="display:block;">
            Checked background color:
            <input
                data-jscolor=""
				style="border-radius: 50px"
                class="form-control"
                name="checked[select__list__item]"
                data-css-selector="id"
                data-css-selector-value="select__list__item"
                data-css-property="background-color"
                onfocus="checkedStyle(this)"
                oninput="checkedStyle(this)"
                <?php if ( isset($design['checked']['select__list__item']) ) { ?>
                value = "<?php echo $design['checked']['select__list__item']?>"
                data-value="1"
                <?php } else { ?>
                value="#003151"
                <?php } ?>
            />
            </label>
    </div>
    <div class="form-group col-sm-12">
        <label style="display:block;">
            Headline background color:
            <input
                data-jscolor=""
				style="border-radius: 50px"
                class="form-control"
                name="selectSpot[id][selectSpotH1][background-color]"
                data-css-selector="id"
                data-css-selector-value="selectSpotH1"
                data-css-property="background-color"
                onfocus="styleELements(this)"
                oninput="styleELements(this)"
                <?php if ( isset($design['selectSpot']['id']['selectSpotH1']['background-color']) ) { ?>
                value = "<?php echo $design['selectSpot']['id']['selectSpotH1']['background-color']?>"
                data-value="1"
                <?php } ?>
            />
        </label>
    </div>
    <div class="form-group col-sm-12">
        <label style="display:block;">
            Headline font color:
            <input
                data-jscolor=""
				style="border-radius: 50px"
                class="form-control"
                name="selectSpot[id][selectSpotH1][color]"
                data-css-selector="id"
                data-css-selector-value="selectSpotH1"
                data-css-property="color"
                onfocus="styleELements(this)"
                oninput="styleELements(this)"
                <?php if ( isset($design['selectSpot']['id']['selectSpotH1']['color']) ) { ?>
                value = "<?php echo $design['selectSpot']['id']['selectSpotH1']['color']?>"
                data-value="1"
                <?php } ?>
            />
        </label>
    </div>
    <div class="form-group col-sm-12">
        <label style="display:block;">
            Label font color:
            <input
                data-jscolor=""
				style="border-radius: 50px"
                class="form-control"
                name="selectSpot[id][labelColor][color]"
                data-css-selector="id"
                data-css-selector-value="labelColor"
                data-css-property="color"
                onfocus="styleELements(this)"
                oninput="styleELements(this)"
                <?php if ( isset($design['selectSpot']['id']['labelColor']['color']) ) { ?>
                value = "<?php echo $design['selectSpot']['id']['labelColor']['color']?>"
                data-value="1"
                <?php } ?>
            />
        </label>
    </div>
    <div class="form-group col-sm-12">
        <label style="display:block;">
            Products list font color:
            <input
                data-jscolor=""
				style="border-radius: 50px"
                class="form-control"
                name="selectSpot[id][productList][color]"
                data-css-selector="id"
                data-css-selector-value="productList"
                data-css-property="color"
                onfocus="styleELements(this)"
                oninput="styleELements(this)"
                <?php if ( isset($design['selectSpot']['id']['productList']['color']) ) { ?>
                value = "<?php echo $design['selectSpot']['id']['productList']['color']?>"
                data-value="1"
                <?php } ?>
            />
        </label>
    </div>

    <div class="form-group col-sm-12">
        <label style="display:block;">
            Products list border color:
            <input
                data-jscolor=""
				style="border-radius: 50px"
                class="form-control"
                name="selectSpot[class][bordersColor][border-color]"
                data-css-selector="class"
                data-css-selector-value="bordersColor"
                data-css-property="border-color"
                onfocus="styleELements(this)"
                oninput="styleELements(this)"
                <?php if ( isset($design['selectSpot']['class']['bordersColor']['border-color']) ) { ?>
                value = "<?php echo $design['selectSpot']['class']['bordersColor']['border-color']?>"
                data-value="1"
                <?php } ?>
            />
        </label>
    </div>
    <div class="form-group col-sm-12">
        <label style="display:block;">
            Confirm button backgorund color:
            <input
                data-jscolor=""
				style="border-radius: 50px"
                class="form-control"
                name="selectSpot[id][confirmButton][background-color]"
                data-css-selector="id"
                data-css-selector-value="confirmButton"
                data-css-property="background-color"
                onfocus="styleELements(this)"
                oninput="styleELements(this)"
                <?php if ( isset($design['selectSpot']['id']['confirmButton']['background-color']) ) { ?>
                value = "<?php echo $design['selectSpot']['id']['confirmButton']['background-color']?>"
                data-value="1"
                <?php } ?>
            />
        </label>
    </div>
    <div class="form-group col-sm-12">
        <label style="display:block;">
            Confirm button font color:
            <input
                data-jscolor=""
				style="border-radius: 50px"
                class="form-control"
                name="selectSpot[id][confirmButton][color]"
                data-css-selector="id"
                data-css-selector-value="confirmButton"
                data-css-property="color"
                onfocus="styleELements(this)"
                oninput="styleELements(this)"
                <?php if ( isset($design['selectSpot']['id']['confirmButton']['color']) ) { ?>
                value = "<?php echo $design['selectSpot']['id']['confirmButton']['color']?>"
                data-value="1"
                <?php } ?>
            />
        </label>
    </div>


    
    

    
</fieldset>
<script>
function hoverStyle(el){
    var color = $(el).val();
    $("#iframe").contents().find("label").removeClass('custom_style');
    $("#iframe").contents().find("label").mouseover(function() {
        $(this).css('background-color', color);
    });
    $("#iframe").contents().find("label").mouseout(function() {
        $(this).attr('style', '');
    });
}

function checkedStyle(el){
    var color = $(el).val();
    $("#iframe").contents().find("head").append('<style>.select__list__item label::before{ background: '+color+' !important}</style>')

    
}
</script>