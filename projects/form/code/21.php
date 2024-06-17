<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
  def create_form_input_tag(helper_sym, name, label_text, options = {}, label_options = {})
    # --- To ensure this isn't misused --- #
    if suffix(helper_sym) == 'field'
      raise FormHelper::InvalidSymbolError, ' WARNING: Be sure to use create_form_input_field to access the field object factory.'
    end
    if not ActionView::Helpers::FormTagHelper.instance_methods.include?(helper_sym)
      raise FormHelper::InvalidSymbolError, ' WARNING: non-applicable symbol (form_tag) given for create_form_input_tag.'
    end
    # --- --- --- --- --- #
    value = {}
    if flash[:info] and flash[:info][name]
      value = {:value => flash[:info][name]}
    end
    label = label_tag name.to_sym, label_text, label_options
    label + self.send(helper_sym, name, nil, options.merge(value))
  end

<?php
    require($root_directory."code_footer.html");
?>
