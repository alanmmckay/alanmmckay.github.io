<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
module ApplicationHelper
  .
  .
  .
  class FormHelper::InvalidSymbolError &lt; StandardError ; end

  def suffix(helper_sym)
    affix = helper_sym.to_s.split('_')
    affix[affix.length - 1]
  end

  private :suffix

  def create_form_input_field(helper_sym, object, method, label_text = "", options = {}, label_options = {})
    if suffix(helper_sym) != 'field'
      raise FormHelper::InvalidSymbolError, ' WARNING: non-applicable symbol (form_field) given for create_form_input_field.'
    end
    value = {}
    if flash[:info] and flash[:info][method]
      value = {:value => flash[:info][method]}
    end
    label = label_tag (object.to_s + "_" +method.to_s).to_sym, label_text, label_options
    ### !!! Need to concatenate the production of label_tag with some produced value derived from helper_sym
  end
  .
  .
  .
end

<?php
    require($root_directory."code_footer.html");
?>
