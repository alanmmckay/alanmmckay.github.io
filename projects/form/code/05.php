<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
class UsersController &lt; ApplicationController

  before_action :authorized, only: [:show]

  def user_params
    params.require(:user).permit(:email, :password, :password_confirmation, :fname, :lname, :phone)
  end

  .
  .
  .

  def new
    if params[:user]
      @user = params[:user]
    end
  end

  .
  .
  .

  def create
    info = user_params
    @user = User.new(email: info[:email], password: info[:password], password_confirmation: info[:password_confirmation], lname: info[:lname], fname: info[:fname], phone: info[:phone])
    if @user.valid?
      @user.save
      flash[:login] = "Account has been created. Please sign in:"
      redirect_to users_path
    else
      #using params here will instead cast as string
      flash[:login] = @user.errors
      info.delete(:password)
      info.delete(:password_confirmation)
      flash[:info] = info
      redirect_to users_new_path
    end
  end

  .
  .
  .

end

<?php
    require($root_directory."code_footer.html");
?>
