<div class="cd-popup-container">
    <div class="card-body ">

        <form action="{{route('entreprise.facture.depenseFactureAdd')}}" method="POST" enctype="multipart/form-data">@csrf
            <div class="row col-md-12 d-flex justify-content-between gx-3 mb-3">
                <div class="d-flex mb-4 justify-content-between">
                    <h4>{{__('messages.invoice')}} {{__('messages.no')}} <span id="get_facture_number_commercial" style="color: red!important"></span></h4>
                    <div class="d-flex justify-content-between">
                        <div class="mr-1">
                            <button type="submit" class="btn btn-success mr-1" style="margin-right: 1em !important">{{__('messages.save')}} </button>

                        </div>
                        <a href="#0" class="btn bg-line-chart-gradient text-light cd-popup-close">Fermer</a>

                    </div>

                </div>


            </div>
            <div class="row col-md-12 d-flex justify-content-start gx-3 mb-3">
                <div class="col-md-2 col-6">
                    <label class="form-label ls text-uppercase text-600 fw-semi-bold mb-0 fs--1"
                        for="fournisseur">{{__('messages.clients_list')}}</label>
                    <select class="form-select mb-3" name="fournisseur" id="fournisseur"
                        aria-label="Default select example">
                        <option hidden>{{__('messages.chose')}}</option>
                        @foreach ($Clients as $client)
                        <option value="{{'C'.$client->id}}">{{$client->entreprise}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-6">
                    <span class="form-check form-switch" style="margin-bottom: 0px !important">
                        <input class="form-check-input" id="flexSwitchCheckChecked" type="checkbox" checked="" />
                        <label style="margin-bottom: 0px !important" class="form-check-label" for="flexSwitchCheckChecked">CC CCI (Send)</label>
                    </span>
                    <textarea class="form-control" name="cc_cci" id="cc_cci" cols="30" rows="1"></textarea>
                </div>





                <div class="col-md-6 col-6 d-none d-md-block d-xl-block d-sm-block "></div>
                <div class="col-md-2 col-6 d-none d-md-block d-xl-block d-sm-block">
                    <span>{{__('messages.amount_to_pay')}}:</span>
                   <h3 id="amount_commercial_facture_pay">{{getCurrency()->sigle}}0.00 </h3>
                </div>
            </div>

            <div class="row gx-3 col-md-12 d-flex justify-content-between mb-3">



                <div class="col-md-2 col-6" >
                    <label class="form-label ls text-uppercase text-600 fw-semi-bold mb-0 fs--1"
                        for="cardNumber">{{__('messages.payment_modality')}}</label>
                    <select class="form-select mb-3" name="paiements_modalite_id" id="paiements_modalite_id_facture"
                        aria-label="Default select example">
                        <option value="" hidden>{{__('messages.chose')}}</option>
                        @foreach ($Modalites as $key=>$Modalite)
                        <option value="{{$Modalite->id}}">{{$Modalite->nom}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-6" >
                    <label class="form-label ls text-uppercase text-600 fw-semi-bold mb-0 fs--1"
                        for="date_facturation">{{__('messages.invoice_date')}}</label>
                    <input class="form-control datetimepicker" name="date_facturation"
                        data-options='{"disableMobile":true}' id="date_facturation_facture"
                        value="{{ \Carbon\Carbon::now() }}" type="text" />
                </div>
                <div class="col-md-2 col-6" >
                    <label class="form-label ls text-uppercase text-600 fw-semi-bold mb-0 fs--1" for="echeance">{{__('messages.due_date')}}</label>
                    {{-- <input class="form-control datetimepicker" name="echeance" id="echeance_facture"
                        type="text" /> --}}
                    <input class="form-control datetimepicker" data-options='{"disableMobile":true}' name="echeance"
                        id="echeance_facture" type="text" />
                </div>
                <div class="col-md-4 d-none d-md-block" ></div>
                <input name="type" value="facture" hidden />
                <input id="Modalites" value="{{$Modalites}}" hidden />
                <div class="col-md-2 col-6" >
                    <label class="form-label ls text-uppercase text-600 fw-semi-bold mb-0 fs--1" for="numero_facture">{{__('messages.invoice')}} {{__('messages.no')}}</label>
                    <input class="form-control" id="numero_facture" name="numero_facture" type="number" />
                </div>

            </div>


                <div class="col-md-12">
                    <div class="table-responsive scrollbar mt-4 fs--1">
                        <table id="test-table" class="table table-striped border-bottom">
                            <thead class="light">
                                <tr class="bg-line-chart-gradient text-white dark__bg-1000">
                                    <th class="border-0">{{__('messages.item')}}</th>
                                        <th class="border-0">{{__('messages.description')}}</th>
                                        <th class="border-0">{{__('messages.quantity')}}</th>
                                        <th class="border-0">{{__('messages.amount')}}</th>
                                        <th class="border-0" hidden>{{__('messages.amount_without_taxe')}}</th>
                                        <th class="border-0">{{__('messages.taxe')}}</th>
                                        <th class="border-0" hidden>{{__('messages.taxe_amount')}}</th>
                                        <th class="border-0">{{__('messages.total_amount')}}</th>
                                        <th class="border-0">-</th>

                                </tr>
                            </thead>
                            <tbody id="dataTable" style="padding: 0px !important; margin: 0px !important">
                                <tr id='row_0' style="padding: 0px !important; ">
                                    <td style="margin-left: 0px !important; padding-left:0px !important">
                                        <select class="form-select mb-3 cartArt" name="article_id[]" id="article_id[]_0"
                                            aria-label="Default select example" oninput="calculate('row_0')">
                                            <option value="" hidden>{{__('messages.chose_item')}}</option>
                                            @foreach ($Articles as $Article)
                                            <option value="{{$Article->id}}">
                                                {{$Article->nom}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="form-control" name="description[]" id="description[]_0"
                                            placeholder="description" type="text" />
                                    </td>
                                    <td>
                                        <input class="form-control" name="qte[]" id="qte[]_0" placeholder="quantité"
                                            type="number" value="1" oninput="calculate('row_0')" />
                                    </td>
                                    <td>
                                        <input class="form-control montantt" name="montant[]" id="montant[]_0"
                                            placeholder="Montant" type="number" oninput="calculate('row_0')" />
                                    </td>
                                    <td hidden>
                                        <input class="form-control total_ht" name="total_ht" id="total_ht_0"
                                            placeholder="Prix HT" type="text" disabled />
                                    </td>
                                    <td>
                                        <select class="form-select mb-3" name="taxe_id[]" id="taxe_id[]_0"
                                            oninput="calculate('row_0')" aria-label="Default select example">
                                            <option value="-1" hidden>{{__('messages.no_taxe')}}</option>
                                            @foreach ($Taxes as $taxe)
                                            <option value="{{$taxe->id}}">{{$taxe->nom}}
                                                ({{$taxe->taux}}%)</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td hidden>
                                        <input class="form-control total_taxe" name="total_taxe" id="total_taxe_0"
                                            placeholder="Montant Taxe" type="text" disabled />
                                    </td>
                                    <td>
                                        <input class="form-control ttc" name="ttc" id="ttc_0" placeholder="Montant TTC"
                                            type="text" disabled />
                                    </td>
                                    <td><i id="trash" data-id="0" class="fa fa-trash text-danger trash"></i>
                                    </td>
                                </tr>
                            </tbody>

                        </table>

                        <input onClick="addRow('dataTable')" class="btn btn-warning" type="button"
                            value='+ Nouvelle ligne' />
                        <input value="{{$Articles}}" type="hidden" id="articles_facture_depense" />
                        <input value="{{$Taxes}}" type="hidden" id="taxe_facture_depense" />
                    </div>



                </div>


                <div class="row gx-3 mt-3 col-md-12 d-flex justify-content-between mb-3">


                    <div class="col-md-3 col-6">
                        <label class="form-label ls text-uppercase text-600 fw-semi-bold mb-0 fs--1"
                            for="message">{{__('messages.msg_on_invoice')}}</label>
                        <textarea name="message" id="" class="form-control" cols="30" id="message" rows="4"> </textarea>
                    </div>
                    <div class="col-md-3 col-6">
                        <label class="form-label ls text-uppercase text-600 fw-semi-bold mb-0 fs--1"
                            for="message_affiche">{{__('messages.msg_on_rapport')}}</label>
                        <textarea name="message_affiche" id="" class="form-control" cols="30" id="message_affiche"
                            rows="4"></textarea>
                    </div>
                    <div class="col-md-3 col-6">
                        <div>
                            <label class="form-label ls text-uppercase text-600 fw-semi-bold mb-0 fs--1"
                                for="has_taxe">{{__('messages.amount_show_with')}}</label>
                            <select class="form-select mb-3" name="has_taxe" id="has_taxe"
                                aria-label="Default select example">
                                <option>{{__('messages.taxe_not_inclued')}}</option>
                                <option>{{__('messages.taxe_inclued')}}</option>
                                <option>{{__('messages.no_taxe')}}</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <label class="form-label ls text-uppercase text-600 fw-semi-bold mb-0 fs--1"
                                for="cardNumber">{{__('messages.pj')}}</label>
                            <input  class="form-control" name="fichier" id="customFile" type="file" />

                        </div>
                    </div>
                    <div class="col-md-3 col-6 bg-line-chart-gradient" >
                        <div class="col-auto mt-3">
                            <table class="table table-sm table-borderless fs--1 text-end">
                                <tr>
                                    <th class="text-light">{{__('messages.sub_total')}}:</th>
                                    <td class="fw-semi-bold text-light total_sans_taxe">0.00 {{getCurrency()->sigle}}</td>
                                </tr>
                                <tr>
                                    <th class="text-light taxe_form">{{__('messages.taxe_amount')}}:</th>
                                    <td class="fw-semi-bold taxe_value text-light">0 {{getCurrency()->sigle}}</td>
                                </tr>

                                <tr class="border-top text-light border-top-2 fw-bolder  d-non">
                                    <th class="text-light">{{__('messages.amount_to_paye')}}:</th>
                                    <td class="total_ttc text-light">0 {{getCurrency()->sigle}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>



                </div>

        </form>
    </div>
</div> <!-- cd-popup-container -->




{{--
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content position-relative">
            <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                    <h4 class="mb-1" id="modalExampleDemoLabel">Ajout nouveau fournisseur </h4>
                </div>
                <div class="p-4 pb-0">
                    <form action="{{route('entreprise.fournisseurs.new.store')}}" class="row g-3 needs-validation"
                        novalidate="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="entreprise">Nom entreprise fournisseur</label>
                                <input class="form-control" name="entreprise" id="entreprise" type="text" required="" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="nom_chequier">Nom sur le chèque</label>
                                <input class="form-control" name="nom_chequier" id="nom_chequier" type="text"
                                    required="" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="nom_pro">Nom sur les facture</label>
                                <input class="form-control" id="nom_pro" name="nom_pro" type="text" required="" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="prenom">Prénom du responsable</label>
                                <input class="form-control" name="prenom" id="prenom" type="text" required="" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="nom">Nom du responsable</label>
                                <input class="form-control" name="nom" id="nom" type="text" required="" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="titre">Titre du responsable</label>
                                <input class="form-control" name="titre" id="titre" type="text" required="" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="col-form-label" for="recipient-name">Recipient:</label>
                                <input class="form-control" id="recipient-name" type="text" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="telephone">Téléphone</label>
                                <input class="form-control" name="telephone" id="telephone" type="text" required="" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="portable">Portable</label>
                                <input class="form-control" name="portable" id="portable" type="text" required="" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="telecopie">Télécopie</label>
                                <input class="form-control" name="telecopie" id="telecopie" type="text" />
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-control" name="email" id="email" type="text" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="website">Site web</label>
                                <input class="form-control" name="website" id="website" type="text" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="numero_compte">Numéro de compte</label>
                                <input class="form-control" name="numero_compte" id="numero_compte" type="text" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="adresse">Adresse</label>
                                <input class="form-control" name="adresse" id="adresse" type="text">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="ville">Ville</label>
                                <input class="form-control" id="ville" name="ville" type="text" />
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="province">Province</label>
                                <input class="form-control" name="province" id="province" type="text" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="code_postal">Code Postal</label>
                                <input class="form-control" name="code_postal" id="code_postal" type="text" />
                            </div>


                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="pays">Pays</label>
                                <select class="form-select" name="pays" id="pays" required="">
                                    <option selected="" disabled="" value="">Chosir</option>
                                    <option value="Sénégal">Sénégal</option>
                                    <option value="Canada">Canada</option>

                                </select>
                                <div class="invalid-feedback">Vous devez choisir un pays</div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="devises_monetaire_id">Devise monétaire</label>
                                <select class="form-select" name="devises_monetaire_id" id="devises_monetaire_id"
                                    required="">
                                    <option selected="" disabled="" value="">Choisir</option>
                                    @foreach ($DevisesMonetaires as $devise)
                                    <option value="{{$devise->id}}">{{$devise->nom}} {{$devise->sigle}}</option>
                                    @endforeach

                                </select>
                                <div class="invalid-feedback">Vous devez choisir une devise pour cette fournisseur</div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="comptescomptable_id">Compte Comptable</label>
                                <select class="form-select" name="comptescomptable_id" id="comptescomptable_id"
                                    required="">
                                    <option disabled="" value="">Choisir</option>

                                    @foreach ($ComptesComptables as $ccomptable)
                                    <option value="{{$ccomptable->id}}">{{$ccomptable->nom}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Vous devez choisir un pays</div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="paiements_modalite_id">Mode de paiement souhaité</label>
                                <select class="form-select" name="paiements_modalite_id" id="paiements_modalite_id"
                                    required="">
                                    <option disabled="" value="">Choisir</option>

                                    @foreach ($ModesPaiements as $pmode)
                                    <option value="{{$pmode->id}}">{{$pmode->nom}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Vous devez choisir un mode de paiement</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="validationCustom05">Note du fournisseur</label>
                                <textarea class="form-control" name="" id="" cols="5" rows="5"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="col-form-label" for="message-text">Message:</label>
                                <textarea class="form-control" id="message-text" cols="5" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div> --}}
