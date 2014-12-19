/**
 * Created by Hesk on 14年2月6日.
 */


//ocdata.get(oc_obj.api_getpending_com, ocReload.browser_store_object_company_pending_list);
render_ui.reg();
ocdata.get(oc_obj.api_getpending_com, ocReload.pending_cb);
