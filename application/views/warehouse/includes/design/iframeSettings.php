<div class="col-lg-12" style="margin:10px 0px; text-align:left">
    <h3 style="margin: 15px 0px 20px 0px">Iframe Settings</h3>
    <div class="form-inline">
        <label for="iframeWidth" style="margin-right:30px">
            Iframe width:&nbsp;&nbsp;
            <input
                type="number"
                id="iframeWidth"
                min="1"
                step="1"
                value="400"
                placeholder="Set iframe width"
                class="form-control"
                style="width:80px"
                oninput="changeIframe('iframeWidth', 'iframeHeight', 'iframeId', 'selectedSpotId', 'categorySortNumberId', 'categoryConatinerId')"
            />
            &nbsp;px
        </label>
        <label for="iframeHeight"  style="margin-right:30px">
            Iframe height:&nbsp;&nbsp;
            <input
                type="number"
                id="iframeHeight"
                min="0"
                step="1"
                value="600"
                placeholder="Set iframe height"
                class="form-control"
                style="width:80px"
                oninput="changeIframe('iframeWidth', 'iframeHeight', 'iframeId', 'selectedSpotId', 'categorySortNumberId', 'categoryConatinerId')"
            />
            &nbsp;px
        </label>
        <label for="categorySortNumberId" style="margin-right:30px">
            Spots:&nbsp;&nbsp;
            <select
                id="selectedSpotId"
                class="form-control"
                onchange="changeIframe('iframeWidth', 'iframeHeight', 'iframeId', 'selectedSpotId', 'categorySortNumberId', 'categoryConatinerId')"
            >
                <option value="">Select spot</option>
                <?php foreach ($spots as $spotType => $typeSpots) { ?>
                    <optgroup label="<?php echo $spotType; ?>">
                        <?php foreach ($typeSpots as $spot) { ?>
                            <option value="&spotid=<?php echo $spot['spotId']; ?>"><?php echo $spot['spotName']; ?></option>
                        <?php } ?>
                    </optgroup>
                    <?php } ?>
            </select>
        </label>
        <label for="categorySortNumberId" id="categoryConatinerId" style="display: none">
            Categories:&nbsp;&nbsp;
            <select
                id="categorySortNumberId"
                class="form-control"
                onchange="changeIframe('iframeWidth', 'iframeHeight', 'iframeId', 'selectedSpotId', 'categorySortNumberId', 'categoryConatinerId')"
            >
                <option value="">Select category</option>
                <?php foreach ($categories as $category) { ?>
                    <option value="&category=<?php echo $category['sortNumber']; ?>"><?php echo $category['category']; ?></option>
                    <?php } ?>
            </select>
        </label>
    </div>    
    <div class="form-group" style="margin-top:30px">
        <label for="iframeId" onclick='copyToClipboard("iframeId")' style="text-align:left; display:block">
            Copy to clipboard:
            <textarea
                class="form-control"
                id="iframeId"
                readonly
                rows="2"
            ><?php
                    #$iframe  = htmlentities('<script src="' . base_url() . 'assets/js/iframeResizer.js"></script>');
                    $iframe = htmlentities('<iframe frameborder="0" style="width:400px; height:600px;" src="' . $iframeSrc . '"></iframe>');
                    #$iframe .= htmlentities('<script>iFrameResize({ scrolling: true, sizeHeight: true, sizeWidth: true, maxHeight:700, maxWidth:400, })</script>');
                    echo $iframe;
            ?></textarea>
        </label>
    </div>
</div>
