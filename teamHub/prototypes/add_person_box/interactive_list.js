

function InteractiveList(outlets) {
		
	// Properties
	var _this = this; // To avoid 'this' conflicts in sub functions
	
	this.UI = {
		container : outlets.countainer,
		text_box : outlets.text_box,
		list_container : outlets.list_container,
		add_button : outlets.add_button,
		add_item_text : (outlets.add_item_text) ? outlets.add_item_text : "Add Items",
	}

	this.items = []; // Holds the list items

	// Methods

	/**
	*	Adds an item to the list (including visually).
	*	@param label (String) : The label of the item in the list.
	*	@param value (String) : The value of the item in case it 
								needs to be submitted.
	*	@param collectionName *optional (String) : This helps if you want
							items submitted as a checkbox array, as it
							it would be implemented as -> name='collectionName[]''
	*/
	this.addItem = function(label, value, collectionName) {

		// Fallback
		collectionName = collectionName || "";

		// If the div.empty exists, then we hide it.
		if (_this.UI.list_container.find(".empty")) {
			_this.UI.list_container.find(".empty").remove();
		}

		// Creating the list item
		var list_item = $("<p class='list-item chip' tag='" + this.items.length + "'>" + label + " <a href='#' class='delete'>x</a></p>");

		// Assigning a delete event to the delete button
		list_item.find('.delete').click(this.onListItemDeleted);

		// Creating a hidden input control (checkbox). For form submittion
		var inputControl = $("<input type='checkbox' 			\
									name='"+collectionName+"[]' 	\
									value='"+value+"'			\
									aria-hidden='true'			\
									style='display:none'			\
									>");
		list_item.append(inputControl); // Adding it to the list item

		// Adding the list item to the list container.
		this.UI.list_container.append(list_item);
	}

	this.deleteItem = function(item) {
		item.remove();

		// Adds the filler text div if the needed (if the list is empty)
		fillerTextIfNeeded();
	}

	/**
	* Adds the filler text div if the needed (if the list is empty)
	*
	*/

	function fillerTextIfNeeded() {

		if (_this.UI.list_container.children().length < 1) {
			var empty = $("<p class=\"empty\">" + _this.UI.add_item_text + "</p>");
			_this.UI.list_container.append(empty);
		}
	}
	
	// Event Handlers
	this.onAddItemClicked = function(e) {

		var text_entered = _this.UI.text_box.val();
			
		if (text_entered.length) {
			_this.addItem(text_entered);
		}
	}

	this.onListItemDeleted = function(e) {

		var item = $(this).parent();
		
		_this.deleteItem(item);
	}

	init();

	function init() {
		
		fillerTextIfNeeded();

		if (_this.UI.add_button){			
			_this.UI.add_button.click(this.onAddItemClicked);
		}

	}

	
}