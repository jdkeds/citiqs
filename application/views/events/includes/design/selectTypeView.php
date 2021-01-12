<fieldset id="selectTypeView" class="hideFieldsets">
    <legend>Select type view</legend>
    <div class="form-group col-sm-12">
        <label style="display:block;">
            Background color:
            <input
                class="form-control colorInput"
                name="selectType[id][selectTypeBody][background-color]"
                data-jscolor=""
                data-css-selector="id"
                data-css-selector-value="selectTypeBody"
                data-css-property="background-color"
				style="border-radius: 50px"
				onfocus="styleELements(this)"
                oninput="styleELements(this)"

                <?php if ( isset($design['selectType']['id']['selectTypeBody']['background-color']) ) { ?>
                value = "<?php echo $design['selectType']['id']['selectTypeBody']['background-color']?>"
                data-value="1"
                <?php } ?>
            />
        </label>
    </div>
    <div class="form-group col-sm-12">
        <label style="display:block;"l>
            Headline background color:
            <input
                data-jscolor=""
                class="form-control"
                name="selectType[id][selectTypeH1][background-color]"
                data-css-selector="id"
                data-css-selector-value="selectTypeH1"
                data-css-property="background-color"
                onfocus="styleELements(this)"
                oninput="styleELements(this)"
				style="border-radius: 50px"
				<?php if ( isset($design['selectType']['id']['selectTypeH1']['background-color']) ) { ?>
                value = "<?php echo $design['selectType']['id']['selectTypeH1']['background-color']?>"
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
                class="form-control"
                name="selectType[id][selectTypeH1][color]"
                data-css-selector="id"
                data-css-selector-value="selectTypeH1"
                data-css-property="color"
				style="border-radius: 50px"
                onfocus="styleELements(this)"
                oninput="styleELements(this)"
                <?php if ( isset($design['selectType']['id']['selectTypeH1']['color']) ) { ?>
                value = "<?php echo $design['selectType']['id']['selectTypeH1']['color']?>"
                data-value="1"
                <?php } ?>
            />
        </label>
    </div>

    <div class="form-group col-sm-12">
        <label style="display:block;">
            Headline font size:
            <input
                type="text"
                class="form-control"
                name="selectType[id][selectTypeH1][font-size]"
                data-css-selector="id"
                data-css-selector-value="selectTypeH1"
                data-css-property="font-size"
                onfocus="styleELements(this)"
                oninput="styleELements(this)"
				style="border-radius: 50px"
                <?php if ( isset($design['selectType']['id']['selectTypeH1']['font-size']) ) { ?>

                    value = "<?php echo $design['selectType']['id']['selectTypeH1']['font-size']?>"

                    data-value="1"
                <?php } ?>
            />
        </label>
    </div>

    <div class="form-group col-sm-12">
        <label style="display:block;">
            Border-radius:
            <input
                type="text"
                class="form-control"
                name="selectType[class][card-img-top][border-top-right-radius]"
                data-css-selector="class"
                data-css-selector-value="card-img-top"
                data-css-property="border-top-right-radius"
                onfocus="borderRadius(this)"
                oninput="borderRadius(this)"
				style="border-radius: 50px"
                <?php if ( isset($design['selectType']['class']['card-img-top']['border-top-right-radius']) ) { ?>

                    value = "<?php echo $design['selectType']['class']['card-img-top']['border-top-right-radius']; ?>"

                    data-value="1"
                <?php } ?>
            />
            <input
                type="hidden"
                id="border-top-left-radius"
                name="selectType[class][card-img-top-2][border-top-left-radius]"
                data-css-selector="class"
                data-css-selector-value="card-img-top-2"
                data-css-property="border-top-left-radius"
                onchange="styleELements(this)"
                oninput="styleELements(this)"
                <?php if ( isset($design['selectType']['class']['card-img-top-2']['border-top-left-radius']) ) { ?>

                    value = "<?php echo $design['selectType']['class']['card-img-top-2']['border-top-left-radius']; ?>"

                    data-value="1"
                <?php } ?>
            />
            <input
                type="hidden"
                id="border-bottom-right-radius"
                name="selectType[class][card-body][border-bottom-right-radius]"
                data-css-selector="class"
                data-css-selector-value="card-body"
                data-css-property="border-bottom-right-radius"
                onchange="styleELements(this)"
                oninput="styleELements(this)"
                <?php if ( isset($design['selectType']['class']['card-body']['border-bottom-right-radius']) ) { ?>

                    value = "<?php echo $design['selectType']['class']['card-body']['border-bottom-right-radius']; ?>"

                    data-value="1"
                <?php } ?>
            />
            <input
                type="hidden"
                id="border-bottom-left-radius"
                name="selectType[class][card-body-2][border-bottom-left-radius]"
                data-css-selector="class"
                data-css-selector-value="card-body-2"
                data-css-property="border-bottom-left-radius"
                onchange="styleELements(this)"
                onkeyup="styleELements(this)"
                <?php if ( isset($design['selectType']['class']['card-body-2']['border-bottom-left-radius']) ) { ?>

                    value = "<?php echo $design['selectType']['class']['card-body-2']['border-bottom-left-radius']; ?>"

                    data-value="1"
                <?php } ?>
            />
        </label>
    </div>


    <div class="form-group col-sm-12">
        <label style="display:block;">
            Card margin-bottom:
            <input
                type="text"
                class="form-control"
                name="selectType[class][places][margin-bottom]"
                data-css-selector="class"
                data-css-selector-value="places"
                data-css-property="margin-bottom"
                onchange="styleELements(this)"
                onkeyup="styleELements(this)"
                style="border-radius: 50px"
                <?php if ( isset($design['selectType']['class']['places']['margin-bottom']) ) { ?>

                    value = "<?php echo $design['selectType']['class']['places']['margin-bottom']; ?>"

                    data-value="1"
                <?php } else {?>
                    value = "10px"
                <?php } ?>
            />
        </label>
    </div>


    <!--
        Add new css property to element h1 in application/views/publicorders/selectType.php view.
        View has h1 tag. Add attribute id with his value. In this case attribute value is selectTypeH1.
        This is part of code from application/views/publicorders/selectType.php view:
            <h1 style="text-align:center" id  =  "selectTypeH1"     ><?php #echo $vendor['vendorName'] ?></h1>

        <div class="form-group col-sm-12">
            <label style="display:block;">
                Headline font size:
                <input
                    type="text"
                    class="form-control"
                    onfocus="styleELements(this)"
                    oninput="styleELements(this)"

                    THIS PART OF THE CODE MAKES CHANGES IN IFRAME OF SELECTED VIEW
                    1. Define css selector name by adding value to data-css-selector attribute
                    data-css-selector = "id" => CSS SELECTOR NAME, IT CAN BE id FOR ONE ELEMENT OR class FOR MORE ELEMENTS (SEE TAG BELOVE FOR CLASS EXAMPLE)
                    
                    2. Define css selector name value by adding value to data-css-selector value
                    data-css-selector-value="selectTypeH1" => CSS SELECTOR VALUE. 

                    3. Define css property that needs to be changes by adding value to data-css-selector value
                    data-css-property="font-size" => CHANGES FONT SIZE OF ELEMENT THAT HAS id="selectTypeH1". PROPERTY VALUE IS INPUT FIELD VALUE

                    
                    THIS GOES TO DB
                    4. SAVE ALL VALUES IN THE tbl_shop_vendors TABLE 
                    selectType      => name of the view on which changes refers
                    id              => attribute name
                    selectTypeH1    => attribte value
                    font-size       => css property

                    name="selectType[id][selectTypeH1][font-size]"
                    <?php #if ( isset($design['selectType']['id']['selectTypeH1']['font-size']) ) { ?>
                    value = "<?php #echo $design['selectType']['id']['selectTypeH1']['font-size']?>"
                    data-value="1"
                    <?php #} ?>
                />
            </label>
        </div>
    -->

    <div class="form-group col-sm-12">
        <label style="display:block;">
            Types background color:
            <input
                data-jscolor=""
                class="form-control"
                name="selectType[class][selectTypeLabels][background-color]"
                data-css-selector="class"
                data-css-selector-value="selectTypeLabels"
                data-css-property="background-color"
                onfocus="styleELements(this)"
                oninput="styleELements(this)"
				style="border-radius: 50px"
                <?php if ( isset($design['selectType']['class']['selectTypeLabels']['background-color']) ) { ?>
                value = "<?php echo $design['selectType']['class']['selectTypeLabels']['background-color']?>"
                data-value="1"
                <?php } ?>
            />
        </label>
    </div>

	<div class="form-group col-sm-12">
		<label style="display:block;">
			Types Radius:
			<input
				type="text"
				class="form-control"
				name="selectType[class][selectTypeLabels][border-radius]"
				data-css-selector="class"
				data-css-selector-value="selectTypeLabels"
				data-css-property="border-radius"
				onfocus="styleELements(this)"
				oninput="styleELements(this)"
				style="border-radius: 50px"
				<?php if ( isset($design['selectType']['class']['selectTypeLabels']['border-radius']) ) { ?>
					value = "<?php echo $design['selectType']['class']['selectTypeLabels']['border-radius']?>"
					data-value="1"
				<?php } ?>
			/>
		</label>
	</div>
</fieldset>
<script>
function borderRadius(el){
    styleELements(el);

    var elVal = $(el).val();
    $("#border-top-left-radius").val(elVal);
    $("#border-bottom-left-radius").val(elVal);
    $("#border-bottom-right-radius").val(elVal);
    
    styleELements(document.getElementById("border-top-left-radius"));
    styleELements(document.getElementById("border-bottom-left-radius"));
    styleELements(document.getElementById("border-bottom-right-radius"));
    
}
</script>
