// Document Type
if( $("#cod_doc_tip").length > 0){
    wsUbigeo('/api/document_type', "#cod_doc_tip", "-- Seleccione el Tipo de Documento --");
}