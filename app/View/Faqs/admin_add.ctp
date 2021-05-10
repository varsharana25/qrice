
<div id="page_content">
    <div id="page_content_inner">

        <div class="md-card">
            <div class="md-card-content">
                <div class="uk-grid" data-uk-grid-margin="">
                    <div class="uk-width-medium-8-10 uk-row-first">
                        <h3 class="heading_a">Add FAQ</h3>
                    </div>

                    <div class="uk-width-medium-2-10" align="right">
                    </div>
                </div>
                <form method="POST" action="#" class="validation_form">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <label>Title</label>
                                <input type="text" name="data[Faq][title]" class="md-input validation[required]" value="<?php echo (!empty($this->request->data['Faq']['title'])) ? $this->request->data['Faq']['title'] : "" ?>"/>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <label>Description</label>
                                <textarea class="md-input validation[required]" name="data[Faq][detail]" rows="5"><?php echo (!empty($this->request->data['Faq']['detail'])) ? $this->request->data['Faq']['detail'] : "" ?></textarea>
                            </div>
                        </div>

                        <div class="uk-width-medium-1-1">
                            <div class="uk-form-row">
                                <button type="submit" class="md-btn md-btn-primary">Add</button>
                                <a href="<?php echo BASE_URL;?>admin/faqs" class="md-btn md-btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>


            </div>
        </div>






    </div>
</div>