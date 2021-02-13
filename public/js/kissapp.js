
let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,
width=0,height=0,left=-1000,top=-1000`;
function popup(url, target) {
    //open('/', 'test', params);
    open(url, target, params);
}
