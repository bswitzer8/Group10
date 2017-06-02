//Set up test data - TBD: get this data from server eventually.
var currentUser = "Group 10";
var tags = [];
tags.push("school");
tags.push("fitness");
tags.push("work");

var items = [];
var item1 = {
	name: "Do some stuff",
	description: "This is the first item",
	location: "4 Goldfield Rd. Honolulu, HI 96815",
	dueDate: new Date(2017, 6, 17, 17, 30, 0, 0),
	priority: 4,
	tags: ["school", "fitness"]
}

var item2 = {
	name: "Do all the things",
	description: "2nd",
	location: null,
	dueDate: new Date(2017, 6, 17, 17, 30, 0, 0),
	priority: 1,
	tags: []
}

var item3 = {
	name: "Get to work already",
	description: "Third item has a long description.  See? It's really long.  Make it longer! Make it so long that it goes to a new line.  Will it look bad? We will find out :) Keep going and going and going and going.",
	location: "44 Shirley Ave. West Chicago, IL 60185",
	dueDate: null,
	priority: 5,
	tags: ["fitness"]
}

items.push(item1);
items.push(item2);
items.push(item3);

function setup() {
	getPageHeading(currentUser);
	getFilterButtons(tags);
	getListitems(items);
}

function getPageHeading(user) {
	document.getElementById("heading").innerHTML = user + "'s To Do List";
}

/*
Adds the following HTML for each "tag" that the user uses:
<div id="ck-buttons">
	<label>
		<input type="checkbox" value="{tagvalue}"><span>{tagvalue}</span>
	</label>
</div>
*/
function getFilterButtons(tags = []) {
	

	var filtersHtml = '';
	for (var i = 0; i < tags.length; i++) {
		filtersHtml +=  
			'<div id="ck-button">' + 
			'<label>' + 
			'<input type="checkbox" value="' +  tags[i] + '"><span>' + tags[i]  + '</span>' + 
			'</label>' +
			'</div>'
	}
	document.getElementById("filters").innerHTML = filtersHtml;
}


/*
This function should only be passed the items that the current user can see.  
Adds the following HTML for each list item the user has:
<div id="list-item" class="transbox">
	<p>Name: {name}</p>
	<p>Description: {description}</p>
	<p>Location: {location}</p>
	<p>Due Date: {dueDate}</p>
	<p>Priority: {priority}</p>
	<p>Tags: {tags}</p>
</div>
*/
function getListitems(items = []) {


	var listHtml = '';

	for (var i = 0; i < items.length; i++) {
		listHtml += 
			'<div id="list-item" class="transbox">' + 
			'<p>Name: ' + items[i].name + '</p>' + 
			'<p>Description: ' + items[i].description + '</p>';

		if (items[i].location != null) {
			listHtml +=
				'<p>Location: ' + items[i].location + '</p>';
		}

		if (items[i].dueDate != null) {
			listHtml +=
				'<p>Due Date: ' + items[i].dueDate + '</p>';
		}

		if (items[i].priority != null) {
			listHtml +=
				'<p>Priority: ' + items[i].priority + '</p>';
		}

		if (items[i].tags.length != 0) {
			listHtml +=
				'<p>Tags: ' + items[i].tags.join('  ') + '</p>';
		}

		listHtml += '</div>';
	}

	document.getElementById("list").innerHTML = listHtml;

}