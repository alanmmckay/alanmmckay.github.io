<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
class User &lt; ActiveRecord::Base
    validates :password, presence: { message: "Password must be filled" }, on: :create
    validates :password_confirmation, presence: { message: "Password must be filled" }, on: :create
    validates :password, confirmation: { message: "Passwords do not match"}, on: :create
    has_secure_password
    validates  :fname, :lname, presence: { message: "Name must be filled"}
    validates :email, uniqueness: {case_sensitive: false, message: "Email already in use"}, on: :create
    validates_with ApplicationHelper::EmailValidator
    has_one :student
    has_one :faculty
    after_initialize :init

    def init
    self.phone ||= ""
    end

  def name
    self.fname + " " + self.lname
  end

  def degrees
    if not self.student.nil?
      self.student.degrees
    end
  end

end

<?php
    require($root_directory."code_footer.html");
?>
