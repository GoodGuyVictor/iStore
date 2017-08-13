/**
 * Created by Victor on 8/12/2017.
 */
function Container(id) {
    this.id = id;
    this.htmlCode = '';
}

Container.prototype.render = function() {
    return this.htmlCode
};