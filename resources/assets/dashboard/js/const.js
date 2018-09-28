var base_url = $('meta[itemprop="url"]').attr('content');
// mobi
const RoutegetOTP = base_url + "/dashboard/mobi/getOTP";
const RoutegetToken = base_url + "/dashboard/mobi/verify";
const RoutecheckPhone = base_url + "/dashboard/mobi/checkphone"
const RouteMobiTopup = base_url + "/dashboard/mobi/topup"

// vina
const RouteVinaTopup = base_url + "/dashboard/vina/topup"

//viettel

const RouteViettelCheckSeri = base_url + "/dashboard/viettel/checkseri"

//data phone

const RoutegetTokenDataphone = base_url + "/dashboard/dataphone/getToken";
const RouteaddPhoneDataphone = base_url + "/dashboard/dataphone/add"