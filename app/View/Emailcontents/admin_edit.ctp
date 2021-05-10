<div class="wrap">
    <section class="app-content">
        <div class="row">
            <div class="col-md-12">
                <div class="widget p-lg">
                    <form class="m-form validation-form" action="#" method="post">
                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label">Email Title <span class="required">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control validate[required]" id="title" name="data[Emailcontent][Title]" value="<?php echo!empty($this->request->data['Emailcontent']['Title']) ? $this->request->data['Emailcontent']['Title'] : ''; ?>"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label">From Name  <span class="required">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control validate[required]" id="fromname" name="data[Emailcontent][fromname]" value="<?php echo!empty($this->request->data['Emailcontent']['fromname']) ? $this->request->data['Emailcontent']['fromname'] : ''; ?>"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label">From Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control validate[custom[email]]" id="fromemail" name="data[Emailcontent][fromemail]" value="<?php echo!empty($this->request->data['Emailcontent']['fromemail']) ? $this->request->data['Emailcontent']['fromemail'] : ''; ?>"/>
                                    </div>
                                </div>
                                <div class="form-group row" style="display:none;">
                                    <label class="col-sm-3 control-label">To Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control validate[custom[email]]" id="toemail" name="data[Emailcontent][toemail]" value="<?php echo!empty($this->request->data['Emailcontent']['toemail']) ? $this->request->data['Emailcontent']['toemail'] : ''; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 r_text" style="display:none;">
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label">CC Mail</label>
                                    <div class="col-sm-9">
                                        <textarea  class="form-control" id="ccemail" rows="5" name="data[Emailcontent][ccemail]"><?php echo!empty($this->request->data['Emailcontent']['ccmail']) ? $this->request->data['Emailcontent']['ccmail'] : ''; ?></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">Subject <span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control validate[required]" id="subject" name="data[Emailcontent][subject]" value="<?php echo!empty($this->request->data['Emailcontent']['subject']) ? $this->request->data['Emailcontent']['subject'] : ''; ?>"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label">Content <span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <?php
                                    $label = explode(",", $this->request->data['Emailcontent']['label']);
                                    $tbltxt = '';
                                    foreach ($label as $lab) {
                                        $labtxt = explode(":", $lab);
                                        $tbltxt.='<tr><td>' . $labtxt[0] . '</td><td>:</td><td>' . $labtxt[1] . '</td></tr>';
                                    }
                                    ?>

                                    <table style="width:100%">
                                        <tr>
                                            <td style="width:100%">
                                                <textarea placeholder="Content" id="content"  class="form-control validate[required]" rows="5" name="data[Emailcontent][emailcontent]"><?php echo!empty($this->request->data['Emailcontent']['emailcontent']) ? $this->request->data['Emailcontent']['emailcontent'] : ''; ?></textarea></td>
                                            <td>

                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $('#content').summernote({
        callbacks: {
            onKeyup: function(e) {
                setTimeout(function() {
                    $("textarea[name='data[Emailcontent][emailcontent]']").html($('#content').val());
                }, 200);
            }
        }
    });
</script>