/*
* Gilbert Alipui
* Teikametrics Earnings Code Challenge
* Adapted code this code from https://github.com/ananddayalan / extjs-by-example-customer-feedback-form
*
* This file is app.js.  It calls ../controller/controller_ajax_calls_model.php whih calls 
*/

Ext.application({

    name: 'MyApp',
    
    launch: function () {

            windowTerms = new Ext.Window({
                autoWidth: true,
                autoHeight: true,
                header: false,
                closable: false,
                modal: false,
                autoScroll: true,
                frame: false,
                border: false,
                html: html
            }); 
            windowTerms.show();
        }

        //function window_termspopClose() {
        //   windowTerms.hide();
        //}

        Ext.create('Ext.container.Viewport', { 
                   
            // Viewport is specialized container which represents the browser’s application view area. 

            scrollable: true,
            
            // the scrollable option to make this child component scrollable. Instead of true or false, this option can also take x or y as values to enable only horizontal or vertical scroll alone.
            
            margin: 20,
            items: [
                {
                    xtype: 'container',
                    
                    layout: {
                        type: 'hbox',
                        align: 'center',
                        pack: 'center'
                    },
                    // the hbox layout is used to arrange  the form panel horizontally in center. 
                    
                    items: [
                        {
                            xtype: 'form',
                            id: 'searchform',
                            
                            maxWidth: 700,
                            flex: 1,
                            // the flex to make the form panel to fill the parent container's width and at the same time limiting max width of the form by setting maxWidth to 700. 
                            
                            bodyPadding: 20,
                            title: 'Teikametrics Earnings Code Challenge',
                            items: [
                                {
                                    xtype: 'fieldcontainer',  
                                    layout: 'hbox',
                                    
                                    // the field container is used with hbox layout to put both the first name and last name under a single label. 
                                    
                                    fieldLabel: 'Position Search',
                                    combineErrors: true,
                                    
                                    defaultType: 'textfield',
                                    /* By setting defaultType at the container level you can avoid repeating xtype for the child components of this container. So by default all child which doesn't xtype set will default to textfield. */
                                    
                                    defaults: {
                                        allowBlank: false,
                                        flex: 1,
										listeners: {
											specialkey: function(field, e){
												if (e.getKey() == e.ENTER) {  // detect the enter key and submit the form
													thebtn = Ext.getCmp('btn');
													thebtn.click(e);
												}
											}
										}
                                    },
                                    // The defaults config allows one to set any config which will be set as default all the child components,  allowBlank is set to false to make the fields as required fields, and flex property is set to make to child components to width of the parent field container equally.                   
                                    items: [{
                                            name: 'name',
                                            id: 'name',
                                            emptyText: 'Enter position like teacher'
                                    }]
                            }],
							// the button is used to submit the form via Ajax
                            buttons: [
									{
										text: 'Submit',
										id: 'btn',
										handler: function () {  // anonymous function handles the form submission after verifying that all required fields are valid
											var form = this.up('form').getForm();
											waitMsg: 'Submitting your data...'
											if (form.isValid()) {
											Ext.Ajax.request({
												useDefaultXhrHeader : false,
												//url: "http://localhost/earnings_code_challenge/controller/controller_ajax1.php",
                                                url: "../controller/controller_ajax_calls_model.php",                                                
												method: 'GET',
												disableCaching: false,
												params: {
														name: form.getValues('name')
													 },
												success: function(response){  // on success, display search results
													//console.log(response.responseText);
													Ext.Msg.alert("Success! " + response.responseText);
												},
												failure: function () {
													Ext.Msg.alert('failure');
												}
											});

                                        } else {  // display an error if there is a failure
                                            Ext.Msg.alert('Error', 'Fix the errors in the form')
                                        }
                                    }
                                },{
                                   text: 'Reset',
                                   id: 'reset',
								   handler: function () {  // anonymous function handles the form submission after verifying that all required fields are valid
									  var form = this.up('form').getForm().reset();									  
								   }
                                }
                            ]
                        }]
                }]

        });
	Ext.getCmp('name').focus('', 10);
    }
});