/**
 * @class Admin_Page_Users
 * @extends Admin_Page_Abstract
 */
var Admin_Page_Users = Admin_Page_Abstract.extend({

	/** @type String */
	_class: 'Admin_Page_Users',

  childrenEvents: {
    'Denkmal_Form_User success.Create': function(form) {
      this.reload();
    }
  }
});
