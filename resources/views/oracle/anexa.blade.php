@extends('layouts.headerOracle')
@section('content')

    <script src="https://code.jquery.com/jquery.js"></script>
    <script>
        function myFunction(id)
        {
            document.getElementById(id).style.display="block";
        }
        function myCollapse(id)
        {
            document.getElementById(id).style.display="none";
        }
    </script>
    <script>
        function InsertViaAjax(idBtn,code,idRst) {
            $('#'+idBtn).html('Sending..');
            var code = $('#'+code).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //Run Ajax

            $.ajax({

                type: "POST",
                url: "{{url('/banca')}}",
                data: {code: code},
                dataType: "JSON",
                success: function (data) {
                    $('#'+idBtn).html('Executed');
                    $('#'+idRst).append('<li>' + data.success + '</li>');
                }
            });

            // To Stop the loading of page after a button is clicked
            return false;
        }
    </script>
    <div class="container my-2">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
            <aside class="card">
                <header class="card-header">
                    <a data-toggle="collapse" data-target="#collapse1" aria-expanded="true" class="">
                        <i class="icon-action fa fa-chevron-down"></i>
                        <h6 class="title">Overview </h6>
                    </a>
                </header>
                <div class="collapse show" id="collapse1" style="">
                    <article class="card-body">
                       <ol>
                           <a href="#p1"><li>Obiectivele și funcțiile aplicației</li></a>
                           <a href="#p2"><li>Limitele aplicației</li></a>
                           <a href="#p3"><li>Reguli de gestiune</li></a>
                           <a href="#p4"><li>Modelul Conceptual al Datelor (MCD) </li></a>
                           <a href="#p5"><li>Modelul logic al Datelor (MLD)      </li></a>
                           <a href="#p6"><li>Descrierea componenetelor/modulelor aplicației și descrierea funcțiilor acestora </li></a>
                           <a href="#p7"><li>Crearea procedurilor pentru implementarea funcțiilor aferente componentelor identificate  </li></a>
                           <a href="#p8"><li>Determinați care din principalele funcții identificate pentru fiecare componentă pot fi implementate ca funcții și scrieți codul pentru ele </li></a>
                           <a href="#p9"><li>În subprogramele pe care le creați tratați și posibilele excepții care pot apărea </li></a>
                           <a href="#p10"><li>Identificați cel puțin 4 situații în care este necesară realizarea unor operații automate în baza de date și scrieți declanșatorii aferenți </li></a>
                           <a href="#p11"><li>Concepeți și creați pachetele care să conțină subprogramele definite la punctele anterioare </li></a>
                           <a href="{{route('getfile', 'Proiect_PLSQL_demo.docx')}}"><li>Descarca proiectul pentru vizualizarea lui completă </li></a>
                           <a href="{{route('getfile', 'Banca.sql')}}"><li>Descarca schema Banca.sql pentru structurele tabelelor</li></a>
                           <a href="{{route('getfile','BancaFullBlocks.sql')}}"><li>Descarca scriptul SQL ce contine toate blocurile pentru parcurgerea mai rapidă a pașilor</li></a>
                       </ol>
                    </article> <!-- card-body.// -->
                </div> <!-- collapse .// -->
            </aside> <!-- card.// -->
            </div>
            <div class="container float-right col-8">
                <h3> Tutorial PL/SQL: Gestiunea activității unei societăți  bancare </h3>
                <ol>
                    <a name="p1"><li> Obiectivele și funcțiile aplicației</li></a>
                    <p>O societate bancară are o listă de activități în cadrul companiei, în acest proiect obiectivul reprezintă creditarea clienților.
                    <p>Aceasta aplicație este menită să stocheze date despre clienții băncii, conturile ce dețin clienții, comisioane, tipuri de credite, pe baza acestora se fac împrumuturi la bancă. În acest sens, se întocmesc contracte de credit în diferite valute și cu diferite dobânzi. Clienții vor rambursa ratele prin conturile bancare ce le posedă. Aplicația va monotoriza evoluția creditelor și rambursările acestora.</p>
                    <p>Unele dintre funcțiile aplicației sunt gestiunea împrumuturilor bancare, coordonarea cliențiilor și creditelor, verificarea corectitudinii rambursărilor. Dezvoltarea mecanismelor care să genereze automat calcule pentru credite, dobânde , rambursări.  Crearea unor statistici și rapoarte privind evoluția rambursărilor.</p>

                    </p>
                    <a name="p2"><li>Limitele aplicației</li></a>
                        <ul>
                            <li>Aplicația este menită doar pentru creditarea clienților cu conturi bancare deja existente</li>
                            <li>Creditele acordate au doar un singur comision</li>
                            <li>Activitatea de creditare are loc la nivelul unei singure bănci.</li>
                            <li>Toate creditele au dobânda simplă (fixă).</li>
                        </ul>
                    <a name="p3"><li>Reguli de gestiune</li></a>
                                <ul>
                                    <li>Contractele de credit nu se acordă minorilor.</li>
                                    <li>Un client poate să dețină mai multe conturi în diferite valute.</li>
                                    <li>Numărul contractelor per persoană este strict limitat de venitul individului.
                                        Suma dobânzelelor rambursate nu trebuie să depășească 40% din veniturile lunare al clientului.
                                    </li>
                                    <li>Clientul va rambursa lunar valoarea creditului și dobanda aferentă.</li>
                                    <li>Valoarea comisionului reprezintă procentul din suma creditului împrumutat si se rambursează lunar.</li>
                                </ul>
                    <a name="p4"><li>Modelul Conceptual al Datelor (MCD) </li></a>
                    <ul>    <p>În acest punct voi explica și detalia construirea și structura entităților pe baza unor două exemple.
                                Asocierea entităților Adresa si Clienti se realizează prin intermediul asociației Locuieste:
                            </p>
                        <li>Legătura dintre entitatea Adresa și asociația Locuieste, are cardinalitatea 1,n deoarece la o adresa poate locui un client sau mai mulți clienți.(ex membrii familiei).</li>
                        <li>Legătura dintre entitatea Clienti si asociația Locuieste, are cardinalitatea 1,1 deoarece fiecare client are o singura adresa. </li>
                        <p>Pe acest principiu sunt construite toate entitățile și atribuite asociații cu cardinalități specifice. Spre exemplu analizăm entitățile Clinti și Contract care au o asociație Solicita</p>
                        <li>Legătura dintre entitatea Clienti și asociația Solicita, are cardinalitatea 1,n
                            deoarece un client poate solicita cel puțin un contract de credit sau mai multe.
                        </li>
                        <li>Legătura dintre entitatea Contract și asociația Solicita, are cardinalitatea 1,1 deoarece un contract este unic și poate fi solicitat doar de un singur client.</li>

                    <button onclick="myFunction('img1')" class="btn-primary btn-block my-1">View</button>
                    <div id="img1" style="display: none;">
                        <p onclick="myCollapse('img1')">collapse</p>
                        <p class="text-center">Figure 1Model MCD</p>
                        <img src="{{asset('front_assets/images/poz1.png')}}" alt="Imagine" class="img-fluid width-auto">
                    </div>
                    </ul>

                    <a name="p5"> <li>Modelul logic al Datelor (MLD) </li></a>
                    <ul>
                        <li>În urma transpunerii regulilor de trecere de la modelul conceptual al datelor la modelul logic al datelor, au rezultat următoarele tabele din imagine, pe care voi exemplifica pe unele în punctul următor.</li>
                        <button onclick="myFunction('img2')" class="btn-primary btn-block my-1">View</button>
                        <div id="img2" style="display: none;">
                            <p onclick="myCollapse('img2')">collapse</p>
                            <p class="text-center">Figure 2 Model MLD</p>
                            <img src="{{asset('front_assets/images/poz2.png')}}" alt="Imagine" class="img-fluid width-auto">
                        </div>
                        <li>Ajustări la nivel de bază de date. Am creat tabela tranzactii pentru a avea evidența tranzacțiilor dintre clienții băncii :</li>
                        <form method="post" action="javascript:void(0)">
                            @csrf
                            <textarea type="text" id="code" name="code" cols="50" rows="6"> create table tranzactii( id_tranzactie  INT NOT NULL PRIMARY KEY,
                                                                                                                    data_t DATE,
                                                                                                                    cont_beneficiar VARCHAR(20),
                                                                                                                    cont_destinatar VARCHAR(20),
                                                                                                                    suma NUMBER(10,2),
                                                                                                                    tip_tranz VARCHAR(45),
                                                                                                                    CONSTRAINT cont_beneficiar_FK FOREIGN KEY (cont_beneficiar) REFERENCES cont(id_cont),
                                                                                                                    CONSTRAINT cont_destinatar_FK FOREIGN KEY (cont_destinatar) REFERENCES cont(id_cont)
                                                                                                                    )
                            </textarea>
                            <ul id="inserted_data">
                            </ul>
                            <button type="submit" id="send_form" onclick="InsertViaAjax('send_form','code','inserted_data');" class="btn-primary btn-block my-1">Execute</button>
                        </form>
                        <li>Am ajustat tabela scadentar cu urmatoarele coloane, suma_rata care reprezinta rata care este necesara returnata, si suma_ramb care clientul efectiv a returnat-o. Similar coloanelor dobanda si comision. </li>
                        <form method="post" action="javascript:void(0)">
                            @csrf
                            <textarea type="text" id="code1" name="code1" cols="50" rows="6"> create table scadentar (
                                                                                                                    nr_rata INT NOT NULL ,
                                                                                                                    nr_contract INT NOT NULL ,
                                                                                                                    suma_rata Number(10,2),
                                                                                                                    suma_ramb Number(10,2),
                                                                                                                    data_scadenta DATE,
                                                                                                                    data_incasarii DATE,
                                                                                                                    dobanda Number(10,2),
                                                                                                                    dobanda_ramb Number(10,2),
                                                                                                                    comision Number(10,2),
                                                                                                                    comision_ramb Number(10,2),
                                                                                                                    sold_credit_ramas Number(10,2),
                                                                                                                    CONSTRAINT PK_contract PRIMARY KEY (nr_rata, nr_contract),
                                                                                                                    CONSTRAINT nr_contract_fk FOREIGN KEY (nr_contract) REFERENCES contract(nr_contract)
                                                                                                                    )

                            </textarea>
                            <ul id="inserted_data1">
                            </ul>
                            <button type="submit" id="send_form1" onclick="InsertViaAjax('send_form1','code1','inserted_data1');" class="btn-primary btn-block my-1">Execute</button>
                        </form>
                        <li>Pentru mai buna gestionare a creditelor și rambursărilor, se va crea o tabelă scadențar_model unde se vor stoca toate ratele, dobânzile, comisioanele calculate care necesită a fi rambursate pentru un credit.</li>
                        <form method="post" action="javascript:void(0)">
                            @csrf
                            <textarea type="text" id="code2" name="code2" cols="50" rows="6"> create table scadentar_model (
                                                                                                                            nr_rata INT NOT NULL ,
                                                                                                                            nr_contract INT NOT NULL ,
                                                                                                                            suma_rata Number(10,2),
                                                                                                                            data_scadenta DATE,
                                                                                                                            dobanda Number(10,2),
                                                                                                                            comision Number(10,2),
                                                                                                                            CONSTRAINT PK_contract_model PRIMARY KEY (nr_rata, nr_contract),
                                                                                                                            CONSTRAINT nr_contract_fk_model FOREIGN KEY (nr_contract) REFERENCES contract(nr_contract)
                                                                                                                            )

                            </textarea>
                            <ul id="inserted_data2">
                            </ul>
                            <button type="submit" id="send_form2" onclick="InsertViaAjax('send_form2','code2','inserted_data2');" class="btn-primary btn-block my-1">Execute</button>
                        </form>
                        <li>Importarea scriptului pentru schema banca in Apex Oracle.</li>
                        <button onclick="myFunction('img3')" class="btn-primary btn-block my-1">View</button>
                        <div id="img3" style="display: none;">
                            <p onclick="myCollapse('img3')">collapse</p>
                            <p class="text-center">Figure 3 Import baza de date Banca</p>
                            <img src="{{asset('front_assets/images/poz3.png')}}" alt="Imagine" class="img-fluid width-auto">
                        </div>
                    </ul>
                    <a name="p6"><li>Descrierea componenetelor/modulelor aplicației și descrierea funcțiilor acestora</li></a>
                    <p>Partea de creditare se referă la funcționarii băncii care vor gestiona efectiv clienții, deschiderea conturilor și alocarea creditelor:</p>
                    <ul>
                        <li>Va introduce/șterge și modifica clienții și toate detaliile ce ține de el(adresă, conturi bancare)</li>
                        <li>Va gestiona și contracta creditele.  </li>
                        <li>Va gestiona evidența rambursărilor creditelor.</li>
                    </ul>
                    <p>Partea de conducere:</p>
                    <ul>
                        <li>Va emite tipurile noi de comisioane</li>
                        <li>Va emite noi reguli de creditare</li>
                        <li>Va elabora limitele de creditare</li>
                    </ul>
                    <p>Partea de administrator:</p>
                    <ul>
                        <li>Va introduce/șterge și modifica tipurile de credite existente.</li>
                        <li>Va introduce/șterge și modifica tipurile de comisioane existente</li>
                        <li>Va genera rapoarte pentru evoluția rambursărilor.</li>
                    </ul>
                    <a name="p7"><li>Crearea procedurilor pentru implementarea funcțiilor aferente componentelor identificate </li></a>
                    <p>Voi crea proceduri pentru două module ale aplicației, partea de administrator și partea de funcționar bancar. Modulul conducere va emite reguli pentru gestiunea bancii, însă administratorul va efectua aceste schimbări în baza de date.(ex: Va introduce/șterge și modifica tipurile de credite existente etc);</p>
                    <p><strong>Pentru modulul angajați:</strong></p>
                    <p>Se vor efectua mai multe actualizari necesare pentru tabela clienti, pentru a asigura integritatea datelor:</p>
                    <p>Se creează o nouă tabelă clienti_date_noi, o copie a tabelei clienti, pentru viitoarele rapoarte și se efectuează unele schimbări asupra lungimii numelui.</p>
                    <form method="post" action="javascript:void(0)">
                        @csrf
                        <textarea type="text" id="code3" name="code3" cols="50" rows="4"> create table clienti_date_noi as select * from clienti

                        </textarea>
                        <ul id="inserted_data3">
                        </ul>
                        <button type="submit" id="send_form3" onclick="InsertViaAjax('send_form3','code3','inserted_data3');" class="btn-primary btn-block my-1">Execute</button>
                    </form>

                    <form method="post" action="javascript:void(0)">
                        @csrf
                        <textarea type="text" id="code4" name="code4" cols="50" rows="8"> create or replace PROCEDURE update_data_clienti IS
                                                                                                e_uppdate_err exception;
                                                                                                BEGIN
                                                                                                update clienti_date_noi
                                                                                                set prenume=substr(nume,1,5)
                                                                                                where (length(nume) + length(prenume))>50;

                                                                                                IF SQL%ROWCOUNT=0 THEN
                                                                                                RAISE e_uppdate_err;
                                                                                                END IF;

                                                                                                EXCEPTION
                                                                                                WHEN e_uppdate_err THEN
                                                                                                DBMS_OUTPUT.PUT_LINE('NU S-A ACTUALIZAT NICI UN RAND !');
                                                                                                end;
                        </textarea>
                        <ul id="inserted_data4">
                        </ul>
                        <button type="submit" id="send_form4" onclick="InsertViaAjax('send_form4','code4','inserted_data4');" class="btn-primary btn-block my-1">Execute</button>
                    </form>
                    <p>Apelarea procedurii <i>update_data_clienti</i> </p>
                    <form method="post" action="javascript:void(0)">
                        @csrf
                        <textarea type="text" id="code5" name="code5" cols="50" rows="4"> begin
                                                                                        update_data_clienti();
                                                                                        end;

                        </textarea>
                        <ul id="inserted_data5">
                        </ul>
                        <button type="submit" id="send_form5" onclick="InsertViaAjax('send_form5','code5','inserted_data5');" class="btn-primary btn-block my-1">Execute</button>
                    </form>
                    <button onclick="myFunction('img4')" class="btn-primary btn-block my-1">View</button>
                    <div id="img4" style="display: none;">
                        <p onclick="myCollapse('img4')">collapse</p>
                        <p class="text-center">Figure 5 Rezultatul apelului procedurei</p>
                        <img src="{{asset('front_assets/images/poz4.png')}}" alt="Imagine" class="img-fluid width-auto">
                    </div>
                    <p>Să se actualizeze datele clienților, se vor înlocui informațiile lungi ce țin de denumirea instituției absolvite cu calificativul: studii: [inferioare, medii, superioare].</p>
                    <form method="post" action="javascript:void(0)">
                        @csrf
                        <textarea type="text" id="code6" name="code6" cols="50" rows="8"> CREATE OR REPLACE PROCEDURE update_data IS
                                                                                            e_upp_exp EXCEPTION;
                                                                                            BEGIN
                                                                                            update clienti set studii='MEDII' WHERE studii LIKE '%Liceu%' or studii LIKE'%Scoala%' ;
                                                                                            update clienti set studii='SUPERIOARE' WHERE studii LIKE'%Universitate%';
                                                                                            update clienti set studii='INFERIOARE' WHERE
                                                                                            studii not LIKE '%Universitate%'
                                                                                            and studii not LIKE '%Liceu%'
                                                                                            and studii not LIKE '%Scoala%' ;
                                                                                            IF SQL%ROWCOUNT=0
                                                                                            THEN RAISE e_upp_exp;
                                                                                            END IF;
                                                                                            EXCEPTION
                                                                                            WHEN e_upp_exp THEN
                                                                                            DBMS_OUTPUT.PUT_LINE('NICI UN UPPDATE EFECTUAT');
                                                                                            END;

                        </textarea>
                        <ul id="inserted_data6">
                        </ul>
                        <button type="submit" id="send_form6" onclick="InsertViaAjax('send_form6','code6','inserted_data6');" class="btn-primary btn-block my-1">Execute</button>
                    </form>
                    <p>Apelarea procedurii <i>update_data</i> </p>
                    <form method="post" action="javascript:void(0)">
                        @csrf
                        <textarea type="text" id="code7" name="code7" cols="50" rows="4"> begin
                                                                                        update_data();
                                                                                        end;

                        </textarea>
                        <ul id="inserted_data7">
                        </ul>
                        <button type="submit" id="send_form7" onclick="InsertViaAjax('send_form7','code7','inserted_data7');" class="btn-primary btn-block my-1">Execute</button>
                    </form>
                    <p>Se va introduce un client nou, datele despre adresă și datele personale:</p>
                    <form method="post" action="javascript:void(0)">
                        @csrf
                        <textarea type="text" id="code8" name="code8" cols="50" rows="10"> CREATE OR REPLACE PROCEDURE adaugare_clienti(p_oras adresa.oras%TYPE, p_strada adresa.strada%TYPE, p_nr adresa.nr%TYPE,p_ap adresa.ap%TYPE, p_tara adresa.tara%TYPE, p_cnp clienti.cnp%TYPE, p_nume clienti.nume%TYPE, p_prenume clienti.prenume%TYPE, p_email clienti.email%TYPE, p_telefon clienti.telefon%TYPE, p_salariu clienti.salariu%TYPE, p_studii clienti.studii%TYPE, p_data_n clienti.data_nasterii%TYPE, p_sex clienti.sex%TYPE) IS
                                                                                            e_insert_add_err exception;
                                                                                            e_insert_cl_err exception;

                                                                                            pragma exception_init(e_format_data_err,-01843);
                                                                                            v_id_adresa2 int;
                                                                                            BEGIN
                                                                                            select max(id_adresa) INTO v_id_adresa2 from adresa;
                                                                                            v_id_adresa2:=v_id_adresa2 + 1;
                                                                                            INSERT INTO adresa VALUES(v_id_adresa2, p_oras, p_strada, p_nr, p_ap, p_tara);
                                                                                            IF SQL%ROWCOUNT=0 THEN
                                                                                            RAISE e_insert_add_err;
                                                                                            END IF;


                                                                                            INSERT INTO clienti VALUES(p_cnp, p_nume, p_prenume, p_email, p_telefon, p_salariu, p_studii, p_data_n, p_sex, v_id_adresa2, tipuri_varsta_f(p_data_n));
                                                                                            IF SQL%ROWCOUNT=0 THEN
                                                                                            RAISE e_insert_cl_err;
                                                                                            END IF;

                                                                                            DBMS_OUTPUT.PUT_LINE('Validare cu succes  pentru clientul: ' || p_cnp|| '__'|| p_nume|| '__'||p_prenume|| '__'||v_id_adresa2);
                                                                                            EXCEPTION
                                                                                            WHEN e_insert_add_err THEN
                                                                                            DBMS_OUTPUT.PUT_LINE('Nu s-a adaugat adresa!');
                                                                                            WHEN e_insert_cl_err THEN
                                                                                            DBMS_OUTPUT.PUT_LINE('Nu s-a adaugat clientul!');
                                                                                            WHEN NO_DATA_FOUND THEN
                                                                                            DBMS_OUTPUT.PUT_LINE('NO_DATA_FOUND');
                                                                                            WHEN TOO_MANY_ROWS THEN
                                                                                            DBMS_OUTPUT.PUT_LINE('Returneaza mai mult decat o inregistrare');
                                                                                            WHEN DUP_VAL_ON_INDEX THEN
                                                                                            DBMS_OUTPUT.PUT_LINE('Nu se respecta integritaatea datelor. Dublicare de chei primare!');
                                                                                            WHEN OTHERS THEN
                                                                                            DBMS_OUTPUT.PUT_LINE('ERROR');
                                                                                            END;
                        </textarea>
                        <ul id="inserted_data8">
                        </ul>
                        <button type="submit" id="send_form8" onclick="InsertViaAjax('send_form8','code8','inserted_data8');" class="btn-primary btn-block my-1">Execute</button>
                    </form>
                    <p>Pentru initierea procedurii se va executa codul de mai jos in Apex, aceasta ofera posibilitatea introducii datelor din consola</p>
                    <p>DECLARE
                        v_oras adresa.oras%TYPE;
                        v_strada adresa.strada%TYPE;
                        v_nr adresa.nr%TYPE;
                        v_ap adresa.ap%TYPE;
                        v_tara adresa.tara%TYPE;
                        v_cnp clienti.cnp%TYPE;
                        v_nume clienti.nume%TYPE;
                        v_prenume clienti.prenume%TYPE;
                        v_email clienti.email%TYPE;
                        v_telefon clienti.telefon%TYPE;
                        v_salariu clienti.salariu%TYPE;
                        v_studii clienti.studii%TYPE;
                        v_data_n clienti.data_nasterii%TYPE;
                        v_sex clienti.sex%TYPE;
                        v_id_adresa clienti.id_adresa%TYPE;
                        BEGIN
                        v_oras:=:v_oras;
                        v_strada:=:v_strada;
                        v_nr:=:v_nr;
                        v_ap:=:v_ap;
                        v_tara:=:v_tara;
                        v_cnp:=:v_cnp;
                        v_nume:=:v_nume;
                        v_prenume:=:v_prenume;
                        v_email:=:v_email;
                        v_telefon:=:v_telefon;
                        v_salariu:=:v_salariu;
                        v_studii:=:v_studii;
                        v_data_n:=:v_data;
                        v_sex:=:v_sex;
                        adaugare_clienti(v_oras, v_strada, v_nr ,v_ap, v_tara, v_cnp, v_nume, v_prenume, v_email, v_telefon, v_salariu, v_studii, v_data_n, v_sex);
                        end;
                    </p>
                    <button onclick="myFunction('img5')" class="btn-primary btn-block my-1">View</button>
                    <div id="img5" style="display: none;">
                        <p onclick="myCollapse('img5')">collapse</p>
                        <p class="text-center">Figure 6 Rezultatul apelului procedurei</p>
                        <img src="{{asset('front_assets/images/poza5.png')}}" alt="Imagine" class="img-fluid width-auto">
                    </div>
                    <p>Se vor înregistra transferurile bancare între clienți. Se va adăuga beneficiarul contului, destinatarul, suma transferată și tipul tranzacției. Se vor trata și excepțiile neprevăzute</p>
                    <form method="post" action="javascript:void(0)">
                        @csrf
                        <textarea type="text" id="code9" name="code9" cols="50" rows="10"> CREATE OR REPLACE  PROCEDURE tranzactie_banca( p_cont_ben IN cont.id_cont%TYPE, p_cont_dest IN cont.id_cont%TYPE, p_suma IN INT, p_tip_tr IN VARCHAR2 ) IS

                                                                                                v_sold_test cont.sold%TYPE;
                                                                                                v_tip_moneda cont.moneda%TYPE;
                                                                                                v_tip_moneda2 cont.moneda%TYPE;

                                                                                                e_no_currency exception;
                                                                                                e_sold exception;
                                                                                                pragma exception_init(e_sold,-20202);
                                                                                                e_no_sold exception;
                                                                                                pragma exception_init(e_no_sold,-20222);



                                                                                                BEGIN
                                                                                                SELECT moneda INTO v_tip_moneda from cont WHERE id_cont=p_cont_ben;
                                                                                                IF v_tip_moneda is NULL THEN
                                                                                                RAISE e_no_currency;
                                                                                                END IF;

                                                                                                SELECT moneda INTO v_tip_moneda2 from cont WHERE id_cont=p_cont_dest;
                                                                                                IF v_tip_moneda=v_tip_moneda2 THEN
                                                                                                 SELECT sold INTO v_sold_test from cont where id_cont=p_cont_ben;
                                                                                                    IF v_sold_test>p_suma THEN
                                                                                                        UPDATE cont set sold=sold-p_suma where id_cont=p_cont_ben;
                                                                                                                 IF SQL%ROWCOUNT=0
                                                                                                                      THEN RAISE_APPLICATION_ERROR(-20202,'Nu a fost actualizat soldul');
                                                                                                                 END IF;

                                                                                                         INSERT INTO tranzactii VALUES(tranzactie_seq.nextval,TO_CHAR(sysdate, 'DD-MON-YY HH24:MI:SS'),p_cont_ben, p_cont_dest,p_suma, p_tip_tr );

                                                                                                        UPDATE cont set sold=sold+p_suma where id_cont=p_cont_dest;
                                                                                                                IF SQL%ROWCOUNT=0
                                                                                                                      THEN RAISE_APPLICATION_ERROR(-20202,'Nu a fost actualizat soldul');
                                                                                                                 END IF;
                                                                                                        DBMS_OUTPUT.PUT_LINE('Tranzactie reusita!');
                                                                                                       ELSE
                                                                                                       RAISE_APPLICATION_ERROR(-20222,'SOLD INSUFICIENT');

                                                                                                       END IF;
                                                                                                ELSE
                                                                                                DBMS_OUTPUT.PUT_LINE('TRANZACTIE ESUATA');
                                                                                                END IF;

                                                                                                EXCEPTION
                                                                                                WHEN e_sold THEN
                                                                                                DBMS_OUTPUT.PUT_LINE('Nu a fost actualizat niciun sold');
                                                                                                WHEN e_no_currency THEN
                                                                                                DBMS_OUTPUT.PUT_LINE('NU EXISTA TIP MONEDA');
                                                                                                WHEN e_no_sold THEN
                                                                                                DBMS_OUTPUT.PUT_LINE('SOLD INSUFICIENT');

                                                                                                WHEN NO_DATA_FOUND THEN
                                                                                                DBMS_OUTPUT.PUT_LINE('NU SUNT DATE');
                                                                                                WHEN DUP_VAL_ON_INDEX THEN
                                                                                                DBMS_OUTPUT.PUT_LINE('Dublare de inregistrai!');
                                                                                                WHEN TOO_MANY_ROWS THEN
                                                                                                DBMS_OUTPUT.PUT_LINE('Returneaza mai mult decat o inregistrare');
                                                                                                WHEN OTHERS THEN
                                                                                                DBMS_OUTPUT.PUT_LINE(SQLCODE||' eroare '||SQLERRM);
                                                                                                END;

                        </textarea>
                        <ul id="inserted_data9">
                        </ul>
                        <button type="submit" id="send_form9" onclick="InsertViaAjax('send_form9','code9','inserted_data9');" class="btn-primary btn-block my-1">Execute</button>
                    </form>
                    <p>Rulare script pentru initierea procedurii<i>tranzactie_banca()</i></p>
                    <form method="post" action="javascript:void(0)">
                        @csrf
                        <textarea type="text" id="code10" name="code10" cols="50" rows="6"> declare
                                                                                                v_cont_ben cont.id_cont%TYPE;
                                                                                                v_cont_dest cont.id_cont%TYPE;
                                                                                                v_suma cont.sold%TYPE;
                                                                                                v_tip_tr VARCHAR2(50);
                                                                                                begin
                                                                                                v_cont_ben:=:v_cont_ben;
                                                                                                v_cont_dest:=:v_cont_dest;
                                                                                                v_suma:=:v_suma;
                                                                                                v_tip_tr:=:v_tip_tr;
                                                                                                tranzactie_banca(v_cont_ben,v_cont_dest,v_suma,v_tip_tr); end;
                        </textarea>
                        <ul id="inserted_data10">
                        </ul>
                        <button type="submit" id="send_form10" onclick="InsertViaAjax('send_form10','code10','inserted_data10');" class="btn-primary btn-block my-1">Execute</button>
                    </form>
                    <button onclick="myFunction('img6')" class="btn-primary btn-block my-1">View</button>
                    <div id="img6" style="display: none;">
                        <p onclick="myCollapse('img6')">collapse</p>
                        <p class="text-center">Figure 7 Caz in care suma transferata depaseste  sum din contul beneficiarului</p>
                        <img src="{{asset('front_assets/images/poz6.png')}}" alt="Imagine" class="img-fluid width-auto">
                    </div>
                    <p><strong>Pentru modulul administrator</strong></p>
                    <p>La tabela clienți se adaugă coloana Grupa_varsta. În funcție de data nașterii,  se introduc în această coloana valorile: “sub 20 de ani”, “între 20 și 25 de ani”, “Intre 26 si 65” și “Pensionari” în dependeță de vârsta persoanei.</p>
                    <form method="post" action="javascript:void(0)">
                        @csrf
                        <textarea type="text" id="code11" name="code11" cols="50" rows="3"> ALTER TABLE CLIENTI add grupa_varsta VARCHAR2(50)
                        </textarea>
                        <ul id="inserted_data11">
                        </ul>
                        <button type="submit" id="send_form11" onclick="InsertViaAjax('send_form11','code11','inserted_data11');" class="btn-primary btn-block my-1">Execute</button>
                    </form>

                    <form method="post" action="javascript:void(0)">
                        @csrf
                        <textarea type="text" id="code12" name="code12" cols="50" rows="10"> CREATE OR REPLACE PROCEDURE tipuri_varsta IS
                                                                                                                            CURSOR c_date IS (select * from clienti) FOR UPDATE NOWAIT;
                                                                                                                            e_cursor_err exception;
                                                                                                                            pragma exception_init(e_cursor_err ,-20112);
                                                                                                                            v_rez int;
                                                                                                                            calificativ VARCHAR2(55);
                                                                                                                            BEGIN
                                                                                                                            FOR c_rand IN c_date LOOP
                                                                                                                            v_rez:=extract(year from sysdate)-extract(year from c_rand.data_nasterii);
                                                                                                                            calificativ:=
                                                                                                                            case
                                                                                                                            when v_rez<20 then 'Sub 20 ani'
                                                                                                                            when v_rez between 20 and 25 then 'Intre 20 si 25'
                                                                                                                            when v_rez between 26 and 65 then 'Intre 26 si 65'
                                                                                                                            else 'Pensionari'
                                                                                                                            END;
                                                                                                                            update clienti set grupa_varsta=calificativ
                                                                                                                            WHERE CURRENT OF c_date;
                                                                                                                            IF SQL%ROWCOUNT=0
                                                                                                                            THEN RAISE_APPLICATION_ERROR(-20112,'NICI UN UPDATE');
                                                                                                                            END IF;
                                                                                                                            END LOOP;

                                                                                                                            EXCEPTION
                                                                                                                            WHEN  e_cursor_err THEN
                                                                                                                            DBMS_OUTPUT.PUT_LINE('Nici un update efectuat');
                                                                                                                            WHEN INVALID_CURSOR THEN
                                                                                                                            DBMS_OUTPUT.PUT_LINE('Cursor invalid');
                                                                                                                            WHEN NO_DATA_FOUND THEN
                                                                                                                            DBMS_OUTPUT.PUT_LINE('Nu sunt date');
                                                                                                                            WHEN VALUE_ERROR THEN
                                                                                                                            DBMS_OUTPUT.PUT_LINE('Tipuri de date/lungimea incompatibile');
                                                                                                                            WHEN OTHERS THEN
                                                                                                                            DBMS_OUTPUT.PUT_LINE('Eroare nespecificata!');
                                                                                                                            END;

                        </textarea>
                        <ul id="inserted_data12">
                        </ul>
                        <button type="submit" id="send_form12" onclick="InsertViaAjax('send_form12','code12','inserted_data12');" class="btn-primary btn-block my-1">Execute</button>
                    </form>
                    <p>Initializarea procedurii <i>tipuri_varsta </i></p>
                    <form method="post" action="javascript:void(0)">
                        @csrf
                        <textarea type="text" id="code13" name="code13" cols="50" rows="2">BEGIN tipuri_varsta; END;

                        </textarea>
                        <ul id="inserted_data13">
                        </ul>
                        <button type="submit" id="send_form13" onclick="InsertViaAjax('send_form13','code13','inserted_data13');" class="btn-primary btn-block my-1">Execute</button>
                    </form>
                    <button onclick="myFunction('img7')" class="btn-primary btn-block my-1">View</button>
                    <div id="img7" style="display: none;">
                        <p onclick="myCollapse('img7')">collapse</p>
                        <p class="text-center">Figure 8 Rezultat</p>
                        <img src="{{asset('front_assets/images/poz7.png')}}" alt="Imagine" class="img-fluid width-auto">
                    </div>
                    <p>Să se afișeze contractele ce întarzie la rambursarea creditului. Să se afișeze numărul de zile restantiere</p>
                    <p>În acest exemplu tratez situația când clientul intârzie să ramburseze creditul raportat la ultima rambursare. În alt exemplu voi afișa  pentru fiecare rată  numarul de zile restanțiere, iar aici nr de zile restanțiere față de ultima rambursare</p>
                    <pre>CREATE OR REPLACE PROCEDURE afisare_intarzieri_viitoare IS
        v_nr_contract scadentar.nr_contract%TYPE;
        v_nr_zile INT;
        v_nr_rata int;
        CURSOR c_nr_contract IS SELECT distinct nr_contract FROM scadentar;
        CURSOR c_rata(p_nr_contract scadentar.nr_contract%TYPE) IS
        SELECT * FROM scadentar WHERE nr_contract=p_nr_contract and nr_rata=(select max(nr_rata) from scadentar WHERE nr_contract=p_nr_contract);
        v_data date;
        BEGIN
        FOR rec_nr_contr IN c_nr_contract LOOP
        FOR rec_rand IN c_rata(rec_nr_contr.nr_contract) LOOP
        v_data:=rec_rand.data_scadenta;
        if( ADD_MONTHS(v_data,1) <= sysdate) THEN
        v_nr_zile:=sysdate-ADD_MONTHS(v_data,1);
        v_nr_contract:=rec_rand.nr_contract;
        v_nr_rata:=rec_rand.nr_rata;
        end if;
        END LOOP;
        DBMS_OUTPUT.PUT_LINE('Contractul nr: '|| v_nr_contract || ' S-a retinut rambursarea cu: '|| v_nr_zile || ' zile');
        END LOOP;
        EXCEPTION
        WHEN NO_DATA_FOUND THEN
        DBMS_OUTPUT.PUT_LINE('NO DATA FAUND');
        WHEN INVALID_CURSOR THEN
        DBMS_OUTPUT.PUT_LINE('Cursor invalid');
        WHEN PROGRAM_ERROR THEN
        DBMS_OUTPUT.PUT_LINE('Eroare de program');
        END;
                    </pre>
                    <p>Initierea blocului:</p>
                    <p>BEGIN
                        afisare_intarzieri_viitoare;
                        END;
                    </p>
                    <button onclick="myFunction('img8')" class="btn-primary btn-block my-1">View</button>
                    <div id="img8" style="display: none;">
                        <p onclick="myCollapse('img8')">collapse</p>
                        <p class="text-center">Figure 9 Rezultat</p>
                        <img src="{{asset('front_assets/images/poz8.png')}}" alt="Imagine" class="img-fluid width-auto">
                    </div>
                    <p>Se dorește să se afișeze clienții care au datorii la rambursare. Se va face recalcul pentru fiecare rata rambursată, se va afișa doar rata afereta contractului care are datorii. La final, se va afișa suma datoriilor pentru creditul curent(diferenta dintre datorii si datoriile rambursate). </p>
               <pre>CREATE OR REPLACE PROCEDURE afisare_datorii IS
                        e_datorii_neg EXCEPTION;
                        e_datorii_exagerate EXCEPTION;
                        CURSOR c_nr_contract IS SELECT distinct nr_contract FROM scadentar;
                          v_datorii_totale int;
                        CURSOR c_rand(p_nr_contract scadentar.nr_contract%TYPE) IS SELECT * FROM scadentar where nr_contract=p_nr_contract;
                        v_datorii  int;

                        BEGIN
                        FOR rec_nr_contr IN c_nr_contract LOOP
                         v_datorii_totale:=0;
                        FOR rec_nr_rata IN c_rand(rec_nr_contr.nr_contract) LOOP
                           v_datorii:=0;
                           v_datorii:=(rec_nr_rata.suma_rata-rec_nr_rata.suma_ramb)+(rec_nr_rata.dobanda-rec_nr_rata.dobanda_ramb)+(rec_nr_rata.comision-rec_nr_rata.comision_ramb);
                           v_datorii_totale:=v_datorii_totale+(v_datorii);
                           IF( v_datorii>5000) THEN
                                RAISE e_datorii_exagerate;
                           ELSIF( v_datorii>0) THEN
                                DBMS_OUTPUT.PUT_LINE('Datorii in valoare de:'|| v_datorii ||' pentru rata nr: '|| rec_nr_rata.nr_rata||' al contractului: '||rec_nr_contr.nr_contract);
                        end if;
                        END LOOP;
                        IF (v_datorii_totale<0) THEN
                        DBMS_OUTPUT.PUT_LINE('Datorii totale: '|| v_datorii_totale || ' pentru creditul cu nr:'||rec_nr_contr.nr_contract);
                        RAISE e_datorii_neg;
                        ELSE
                        DBMS_OUTPUT.PUT_LINE('Datorii totale: '|| v_datorii_totale || ' pentru creditul cu nr:'||rec_nr_contr.nr_contract);
                        END IF;
                        END LOOP;
                        EXCEPTION
                        WHEN e_datorii_exagerate THEN
                        DBMS_OUTPUT.PUT_LINE('DATORII DEPASESTE VALOAREA DE 5000, REVIZUITI RAMBURSARILE!');
                        WHEN e_datorii_neg THEN
                        DBMS_OUTPUT.PUT_LINE('SUMA DATORII TOTALE NEGATIVE, SUMA RAMBURSATA IN PLUS, REVIZUITI RAMBURSARILE!');
                        WHEN INVALID_CURSOR THEN
                        DBMS_OUTPUT.PUT_LINE('Cursor invalid');
                        WHEN NO_DATA_FOUND THEN
                        DBMS_OUTPUT.PUT_LINE('Nu sunt date');
                END;

               </pre>
                    <p>Initializarea blocului</p>
                    <p>BEGIN
                        afisare_datorii;
                        END;
                    </p>
                    <p>Vizualizare rezultat:</p>
                    <button onclick="myFunction('img9')" class="btn-primary btn-block my-1">View</button>
                    <div id="img9" style="display: none;">
                        <p onclick="myCollapse('img9')">collapse</p>
                        <p class="text-center">Figure 10 Rezultatul procedurii cu exceptie</p>
                        <img src="{{asset('front_assets/images/poz9.png')}}" alt="Imagine" class="img-fluid width-auto">
                        <p class="text-center">Figure 11 Rezultatul afisarea datoriilor</p>
                        <img src="{{asset('front_assets/images/poz10.png')}}" alt="Imagine" class="img-fluid width-auto">
                        <p>P.S in cazul creditului 1012 are o datorie pentru rata nr1:125 lei, insa datorii totale0 deoarece a returnat datoria in alte rambursari.</p>
                    </div>
                    <p><strong>Pentru modulul angajați</strong></p>
                    <p>Pentru un client, se va afișa soldul creditului rămas pentru rambursare. Se va introduce un paramentru de intrare care este nr_contract și se va returna suma necesară de rambursat.Am folosit funcția min() pentru că o dată rambursat o rată, soldul creditului de rambursat scade, respectiv este suma cea mai mică.</p>
                    <pre>CREATE OR REPLACE PROCEDURE verifica_date( p_nr_contract IN OUT scadentar.nr_contract%TYPE, p_sold  OUT scadentar.sold_credit_ramas%TYPE ) IS
                            BEGIN
                            SELECT min(sold_credit_ramas) into p_sold from scadentar where nr_contract=p_nr_contract;
                            EXCEPTION
                            WHEN NO_DATA_FOUND THEN
                            DBMS_OUTPUT.PUT_LINE('NO DATA FOUND');
                            END;
                    </pre>
                    <p>Initializare procedura:</p>
                    <pre>DECLARE
                        v_nr_contract scadentar.nr_contract%TYPE;
                        v_sold int;
                        BEGIN
                        v_nr_contract:=:v_nr_contract ;
                        verifica_date(v_nr_contract ,v_sold);
                        DBMS_OUTPUT.PUT_LINE('Pentru contractul nr:'||v_nr_contract || ' Sold credit ramas: ' || v_sold);
                        DBMS_OUTPUT.PUT_LINE(calcul_dobanda(v_sold,v_nr_contract)) ;
                        END;
                    </pre>
                    <button onclick="myFunction('img11')" class="btn-primary btn-block my-1">View</button>
                    <div id="img11" style="display: none;">
                        <p onclick="myCollapse('img11')">collapse</p>
                        <p class="text-center">Figure 11 Rezultatul procedurii</p>
                        <img src="{{asset('front_assets/images/poz11.png')}}" alt="Imagine" class="img-fluid width-auto">
                    </div>
                    <p>Să se creeze o procedură care va permite încasarea rambursărilor și returnarea soludui creditului rămas pentru rambursările viitoare. Să se verifice dacă sumele de rambursat nu depășesc valoarea disponibilă din contul clientului. Se va declanșa un trigger care actualizează soldul din cont, dacă rambursarea a avut loc cu succes.</p>
                <pre>
                    CREATE OR REPLACE PROCEDURE rambursari( p_nr_contr contract.nr_contract%TYPE, p_suma Number, p_suma_rb Number, p_data_scr DATE, p_data_ramb DATE, p_dobanda Number, p_dob_ramb Number, p_comision Number, p_com_ramb Number, p_sold_credit_ramas IN OUT Number) IS
                        v_sold int;
                        v_nr_contract  int;
                        v_nr_rata int;
                        e_not_insert EXCEPTION;
                        e_no_sold EXCEPTION;

                        BEGIN
                        SELECT sold INTO v_sold from cont WHERE id_cont=(SELECT id_cont from contract where nr_contract=p_nr_contr);
                        IF(v_sold>(p_suma_rb+p_dob_ramb+p_com_ramb)) THEN
                        SELECT max(nr_rata) into v_nr_rata from scadentar WHERE nr_contract=p_nr_contr;
                        IF v_nr_rata IS NOT NULL THEN
                            SELECT sold_credit_ramas into p_sold_credit_ramas from scadentar WHERE nr_contract=p_nr_contr and nr_rata=v_nr_rata;
                           v_nr_rata:=v_nr_rata+1;
                           p_sold_credit_ramas:=p_sold_credit_ramas-(p_suma_rb);
                           INSERT INTO scadentar VALUES (v_nr_rata, p_nr_contr, p_suma, p_suma_rb, p_data_scr, p_data_ramb, p_dobanda, p_dob_ramb, p_comision, p_com_ramb, p_sold_credit_ramas);

                        IF SQL%ROWCOUNT=0 THEN
                        RAISE e_not_insert;
                        ELSE
                        DBMS_OUTPUT.PUT_LINE('Rambursare cu succes!');
                        END IF;

                        ELSE
                         v_nr_rata:=1;
                          p_sold_credit_ramas:=p_sold_credit_ramas-(p_suma_rb);
                          INSERT INTO scadentar VALUES (v_nr_rata, p_nr_contr, p_suma, p_suma_rb, p_data_scr, p_data_ramb, p_dobanda, p_dob_ramb, p_comision, p_com_ramb, p_sold_credit_ramas);
                         IF SQL%ROWCOUNT=0 THEN
                             RAISE e_not_insert;
                           ELSE
                              DBMS_OUTPUT.PUT_LINE('Rambursare cu succes!');
                           END IF;

                        END IF;
                        ELSE
                        RAISE e_no_sold;
                        END IF;

                        EXCEPTION
                        WHEN e_no_sold THEN
                        DBMS_OUTPUT.PUT_LINE('SOLD INSUFICIENT PENTRU RAMBURSARE');
                        WHEN e_not_insert THEN
                        DBMS_OUTPUT.PUT_LINE('NO ROW WAS INSERTED');
                        WHEN NO_DATA_FOUND THEN
                            DBMS_OUTPUT.PUT_LINE('NO DATA FAUND');
                        WHEN TOO_MANY_ROWS THEN
                        DBMS_OUTPUT.PUT_LINE('Returneaza mai mult decat o inregistrare');
                        WHEN OTHERS THEN
                        DBMS_OUTPUT.PUT_LINE('ERROR');
                    END;
                </pre>
                    <p>Initializareablocului:</p>
                    <pre>DECLARE
                            V_DATA1 DATE:=:V_DATA1;
                            V_DATA2 DATE:=:V_DATA2;
                            v_nr_contract contract.nr_contract%TYPE:=:v_nr_contract;
                            v_suma_r  scadentar.suma_rata%TYPE:=:v_suma_r;
                            v_suma_ramb scadentar.suma_ramb%TYPE:=:v_suma_ramb;
                            v_dobanda  scadentar.dobanda%TYPE:=:v_dobanda;
                            v_dobanda_r  scadentar.dobanda_ramb%TYPE:=:v_dobanda_r ;
                            v_comision  scadentar.comision%TYPE:=:v_comision;
                            v_com_ramb  scadentar.comision_ramb%TYPE:=:v_com_ramb;
                            v_sold_credit_ramas  contract.suma_credit%TYPE;
                            BEGIN
                            select suma_credit into v_sold_credit_ramas from contract where nr_contract=v_nr_contract;
                            rambursari(v_nr_contract,v_suma_r,v_suma_ramb,V_DATA1,V_DATA2,v_dobanda,v_dobanda_r,v_comision,v_com_ramb,v_sold_credit_ramas);
                            DBMS_OUTPUT.PUT_LINE('Sold credit ramas: '|| v_sold_credit_ramas);
                            END;
                    </pre>
                    <button onclick="myFunction('img12')" class="btn-primary btn-block my-1">View</button>
                    <div id="img12" style="display: none;">
                        <p onclick="myCollapse('img12')">collapse</p>
                        <p class="text-center">Figure 12 Rezultatul procedurii</p>
                        <img src="{{asset('front_assets/images/poz12.png')}}" alt="Imagine" class="img-fluid width-auto">
                    </div>
                    <p><strong>Pentru modulul administator</strong></p>
                    <p>Să se afișeze contractele clienților care au întârziat cu rambursarea creditului. Pentru fiecare rata se vor arata nr de zile restanțiere.</p>
                    <pre>CREATE OR REPLACE PROCEDURE afisare_intarzieri( p_nr_contract OUT INT, p_nr_zile OUT INT , p_nr_rata OUT INT ) IS
                            e_data_limita EXCEPTION;
                            PRAGMA EXCEPTION_INIT(e_data_limita,-20122);
                            CURSOR c_nr_contract IS SELECT distinct nr_contract FROM scadentar;

                            CURSOR c_rata(p_nr_contract scadentar.nr_contract%TYPE) IS
                               SELECT * FROM scadentar  WHERE nr_contract=p_nr_contract;

                            v_data date;
                            v_data_ramb date;
                            BEGIN
                            FOR rec_nr_contr IN c_nr_contract LOOP
                            FOR rec_rand IN c_rata(rec_nr_contr.nr_contract) LOOP

                              v_data:=rec_rand.data_scadenta;
                              v_data_ramb:=rec_rand.data_incasarii;
                              if( v_data != v_data_ramb) THEN
                                p_nr_zile:=v_data_ramb-v_data;
                                p_nr_contract:=rec_rand.nr_contract;
                                p_nr_rata:=rec_rand.nr_rata;
                                IF (p_nr_zile>365) THEN
                                   RAISE_APPLICATION_ERROR(-20122,'LIMITA MAXIMA DE INTARZIERE!');
                                END IF;
                            end if;
                            END LOOP;
                            END LOOP;
                            EXCEPTION
                            WHEN e_data_limita THEN
                            DBMS_OUTPUT.PUT_LINE('LIMITA MAXIMA DE INTARZIERE!');
                            WHEN INVALID_CURSOR THEN
                            DBMS_OUTPUT.PUT_LINE('Cursor invalid');
                            WHEN NO_DATA_FOUND THEN
                                DBMS_OUTPUT.PUT_LINE('NO DATA FAUND');
                            WHEN OTHERS THEN
                            DBMS_OUTPUT.PUT_LINE('ERROR');
                        END;
                    </pre>
                    <p>Initializarea blocului</p>
                    <pre>declare
                            v_nr_contract  scadentar.nr_contract%TYPE;
                            v_nr_zile  INT;
                            v_nr_rata  scadentar.nr_rata%TYPE;
                            BEGIN
                            afisare_intarzieri(v_nr_contract, v_nr_zile, v_nr_rata);
                            DBMS_OUTPUT.PUT_LINE('Contractul nr: '|| v_nr_contract ||' Nr rata: '|| v_nr_rata|| ' S-a retinut rambursarea cu: '|| v_nr_zile || ' zile');
                        END;
                        </pre>
                    <button onclick="myFunction('img13')" class="btn-primary btn-block my-1">View</button>
                    <div id="img13" style="display: none;">
                        <p onclick="myCollapse('img13')">collapse</p>
                        <p class="text-center">Figure 13 Rezultatul apelului procedurei cu declansarea erorii</p>
                        <img src="{{asset('front_assets/images/poz13.png')}}" alt="Imagine" class="img-fluid width-auto">
                        <p class="text-center">Figure 14 Rezultatul dorit afisat de procedura</p>
                        <img src="{{asset('front_assets/images/poz14.png')}}" alt="Imagine" class="img-fluid width-auto">
                    </div>
                  <a name="p8"><li>Determinați care din principalele funcții identificate pentru fiecare componentă pot fi implementate ca funcții și scrieți codul pentru ele</li></a>
                <p><strong>Pentru modulul administrator</strong></p>
                    <p>Să se introducă calificativul de vârstă pentru fiecare client în momentul introducerii lui în baza de date. Această funcție se va apela în procedura  adaugare_clienti() când se introduce un client nou.</p>
                <pre>CREATE OR REPLACE FUNCTION tipuri_varsta_f(p_data Date) RETURN VARCHAR2 IS
                        v_rez int;
                        calificativ VARCHAR2(55);
                        BEGIN

                        v_rez:=extract(year from sysdate)-extract(year from p_data);
                        calificativ:=
                        case
                        when v_rez<20 then 'Sub 20 ani'
                        when v_rez between 20 and 25 then 'Intre 20 si 25'
                        when v_rez between 26 and 65 then 'Intre 26 si 65'
                        else 'Pensionari'
                        END;
                        RETURN calificativ;
                        EXCEPTION
                        WHEN VALUE_ERROR THEN
                        RETURN 'Tipuri de date/lungimea incompatibile';
                    END;
                    </pre>
                    <p>Initiere bloc:</p>
                    <pre>
                        DECLARE
                            v_data date:='15-MAY-1999';
                            BEGIN
                            DBMS_OUTPUT.PUT_LINE(tipuri_varsta_f(v_data));
                        END;
                    </pre>
                    <button onclick="myFunction('img15')" class="btn-primary btn-block my-1">View</button>
                    <div id="img15" style="display: none;">
                        <p onclick="myCollapse('img15')">collapse</p>
                        <p class="text-center">Figure 15 Rezultat</p>
                        <img src="{{asset('front_assets/images/poz15.png')}}" alt="Imagine" class="img-fluid width-auto">
                    </div>
                    <p><strong>Pentru modulul angajat</strong></p>
                    <p>Pentru toate procedurile create anterior se afișează contractul clintului, de data aceasta, se va crea o funcție ce va returna numele și prenumele clientului pentru fiecare număr contract trimis ca parametru.</p>
                <pre>
                    CREATE OR REPLACE FUNCTION nume_client(p_nr_contr contract.nr_contract%TYPE) RETURN VARCHAR2 IS
                        v_nume clienti.nume%TYPE;
                        v_prenume clienti.prenume%TYPE;
                        v_nr_contract contract.nr_contract%TYPE;
                        v_rez VARCHAR2(80);

                        BEGIN
                        SELECT nume, prenume, nr_contract INTO v_nume, v_prenume, v_nr_contract FROM  clienti c JOIN contract cr on c.cnp=cr.cnp WHERE nr_contract=p_nr_contr;

                        RETURN (v_nume|| ' '||v_prenume);

                        EXCEPTION
                        WHEN INVALID_CURSOR THEN
                        RETURN  'Cursor invalid';
                        WHEN NO_DATA_FOUND THEN
                        RETURN  'NO DATA FOUND';
                        WHEN VALUE_ERROR THEN
                        RETURN  'Tipuri de date/lungimea incompatibile';
                    END;
                </pre>
                    <p>Initiere bloc</p>
                    <p>BEGIN
                        DBMS_OUTPUT.PUT_LINE(nume_client(1012));
                        END;
                    </p>
                    <button onclick="myFunction('img16')" class="btn-primary btn-block my-1">View</button>
                    <div id="img16" style="display: none;">
                        <p onclick="myCollapse('img16')">collapse</p>
                        <p class="text-center">Figure 16 Rezultat</p>
                        <img src="{{asset('front_assets/images/poz16.png')}}" alt="Imagine" class="img-fluid width-auto">
                    </div>
                   <a name="p9"> <li>În subprogramele pe care le creați tratați și posibilele excepții care pot apărea</li></a>
                    <p>Excepțiile sunt tratate în cod. Am folosit exceptii Oracle:</p>
                    <ol>
                        <li>INVALID_CURSOR</li>
                        <li>DUP_VAL_ON_INDEX</li>
                        <li>INVALID_NUMBER</li>
                        <li>NO_DATA_FOUND</li>
                        <li>TOO_MANY_ROWS</li>
                        <li>ZERO_DIVIDE</li>
                        <li>VALUE_ERROR</li>
                    </ol>
                    <a name="p10"><li>Identificați cel puțin 4 situații în care este necesară realizarea unor operații automate în baza de date și scrieți declanșatorii aferenți</li></a>
                    <p>După rambursarea unei rate, să se actualizeze soldul din contul bancar pe baza căruia s-a efectuat rambursarea</p>
                <pre>CREATE OR REPLACE TRIGGER actualizare_sold
                        AFTER INSERT ON scadentar FOR EACH ROW
                        DECLARE
                        BEGIN
                        UPDATE CONT SET SOLD=SOLD-(:NEW.SUMA_RAMB+:NEW.DOBANDA_RAMB+:NEW.COMISION_RAMB) WHERE ID_CONT=(SELECT id_cont from contract where nr_contract=:NEW.NR_CONTRACT);
                        EXCEPTION
                        WHEN NO_DATA_FOUND THEN
                        DBMS_OUTPUT.PUT_LINE('NO DATA FOUND');
                        END
                </pre>
                    <p>Dacă un funcționar bancar nu folosește procedura menită pentru rambursare, pentru anticiparea introducerii ratei greșite, se va verifica dacă există rata precedentă în baza de date, altfel va fi înserată rata corectă(cea precedentă sau 1 în cazul când este prima rambursare).</p>
                <pre>
                    CREATE OR REPLACE TRIGGER check_nr_rata
                        BEFORE INSERT  ON scadentar FOR EACH ROW
                        DECLARE
                        v_var scadentar.nr_rata%TYPE;
                        BEGIN
                        SELECT nr_rata INTO v_var from scadentar where nr_rata= :NEW.nr_rata-1 and nr_contract=:NEW.nr_contract;
                        EXCEPTION
                        WHEN NO_DATA_FOUND THEN
                        SELECT max(nr_rata) into v_var from scadentar WHERE nr_contract=:NEW.nr_contract;
                        IF(v_var IS NOT NULL) THEN
                        INSERT INTO scadentar VALUES ((v_var+1),:NEW.nr_contract, :NEW.SUMA_RATA, :NEW.SUMA_RAMB, :NEW.DATA_SCADENTA, SYSDATE,:NEW.DOBANDA,:NEW.DOBANDA_RAMB,:NEW.COMISION, :NEW.COMISION_RAMB,:NEW.SOLD_CREDIT_RAMAS);
                        DBMS_OUTPUT.PUT_LINE('NU SE RESPECTA ORDINEA RAMBURSARILOR, S-A INSERAT O RATA GENERATA CORECT '||(v_var+1));
                        ELSE
                        INSERT INTO scadentar VALUES (1,:NEW.nr_contract, :NEW.SUMA_RATA, :NEW.SUMA_RAMB, :NEW.DATA_SCADENTA, SYSDATE,:NEW.DOBANDA,:NEW.DOBANDA_RAMB,:NEW.COMISION, :NEW.COMISION_RAMB,:NEW.SOLD_CREDIT_RAMAS);
                        DBMS_OUTPUT.PUT_LINE('NU SE RESPECTA ORDINEA RAMBURSARILOR, S-A INSERAT O RATA GENERATA CORECT:1 ');
                        END IF;
                    END
                </pre>
                    <p>Verificăm ultima rată- SELECT * from scadentar WHERE NR_CONTRACT=1012 order by nr_rata asc  </p>
                    <button onclick="myFunction('img17')" class="btn-primary btn-block my-1">View</button>
                    <div id="img17" style="display: none;">
                        <p onclick="myCollapse('img17')">collapse</p>
                        <p class="text-center">Figure 17 Rezultat</p>
                        <img src="{{asset('front_assets/images/poz17.png')}}" alt="Imagine" class="img-fluid width-auto">
                    </div>
                    <p>Inserăm o înregistrare cu nr_rata -15<p>
                    <p> insert into scadentar values (15,1012,900,950,SYSDATE, SYSDATE,375,450,9,9,80950);</p>
                    <button onclick="myFunction('img18')" class="btn-primary btn-block my-1">View</button>
                    <div id="img18" style="display: none;">
                        <p onclick="myCollapse('img18')">collapse</p>
                        <p class="text-center">Figure 18 Rezultat in urma declansarii triggerului</p>
                        <img src="{{asset('front_assets/images/poz18.png')}}" alt="Imagine" class="img-fluid width-auto">
                    </div>
                <a name="p11"><li>Concepeți și creați pachetele care să conțină subprogramele definite la punctele anterioare</li></a>
                    <ul>
                        <li>stabiliți care sunt subprogramele publice și care sunt cele private;</li>
                        <li>folosiți conceptul de FORWARD DECLARATION</li>
                        <li>pentru cel putin 2 subprograme implementați conceptul de OVERLOADING</li>
                        <li>cel puțin la un pachet identificați o situație în care puteți utiliza blocul de inițializare al pachetului (Package Initialization Block</li>
                    </ul>
                    <pre>create table evidenta_salariu(
                        data_sal date primary key,
                        suma Number(10,2))
                        </pre>
                    <pre>BEGIN
                        INSERT INTO evidenta_salariu VALUES(to_date('20-MAY-2018','DD-MM-YYYY'),2354);
                        INSERT INTO evidenta_salariu VALUES(to_date('25-Jun-2019','DD-MM-YYYY'),2374);
                        INSERT INTO evidenta_salariu VALUES(to_date('19-MAY-2020','DD-MM-YYYY'),2554);
                        END
                    </pre>
                    <p>-Se vor organiza toate subprogramale care răspund de rambursarea creditului</p>
                    <p>În acest pachet, <i>g_sal_minim</i> este variabila globală, FUNCTION <i>rambursari()</i> si PROCEDURE <i>rambursari()</i> sunt subprograme publice care au conceputul overloading.</p>
                    <p>În pachet am declarat cu FORWARD DECLARATION funcția <i>calcul_dobanda()</i> care la rândul ei este privată. La final am folosit Package Initialization Block în care variabila globală preia salariu minim pe economie care se schimă în fiecare an.</p>
                <pre>
                    <strong>CREATE OR REPLACE PACKAGE returnDetails_pkg IS</strong>
                            g_sal_minim Number(10,2);
                            FUNCTION rambursari(p_nr_contr contract.nr_contract%TYPE) RETURN INT;
                            PROCEDURE rambursari( p_nr_contr contract.nr_contract%TYPE, p_suma Number, p_suma_rb Number, p_data_scr DATE, p_data_ramb DATE, p_dobanda Number, p_dob_ramb Number, p_comision Number, p_com_ramb Number, p_sold_credit_ramas IN OUT Number);

                            END returnDetails_pkg;
                    <strong>CREATE OR REPLACE PACKAGE BODY returnDetails_pkg IS</strong>
                                p_nr_contract contract.nr_contract%TYPE;
                                FUNCTION calcul_dobanda(p_sold INT, p_nr_contr contract.nr_contract%TYPE)
                            RETURN INT;
                    <strong>FUNCTION rambursari(p_nr_contr contract.nr_contract%TYPE) RETURN INT IS</strong>
                    CURSOR c_contract IS SELECT * FROM CONTRACT WHERE nr_contract=p_nr_contr;
                        v_sold int;
                        v_nr contract.durata_credit%TYPE;
                        v_suma_rata contract.suma_credit%TYPE;
                        v_data DATE;
                        v_dobanda contract.dobanda%TYPE;
                        v_comision contract.valoare_comision%type;
                        BEGIN
                        SELECT suma_credit into v_sold from contract where nr_contract=p_nr_contr;
                        FOR c_rata in c_contract LOOP
                        v_nr:=c_rata.durata_credit;
                        v_suma_rata:=(c_rata.suma_credit/c_rata.durata_credit);
                        v_dobanda:=calcul_dobanda(v_sold,p_nr_contr);
                        v_sold:=v_sold-v_dobanda;
                        v_comision:=(c_rata.valoare_comision/v_nr);
                        v_data:=c_rata.data_contract;
                        FOR c in 1..v_nr LOOP
                        v_data:=ADD_MONTHS(v_data,1);
                        INSERT INTO scadentar_model VALUES(c, c_rata.nr_contract, v_suma_rata, v_data, v_dobanda, v_comision);
                        END LOOP;
                        END LOOP;
                        RETURN v_nr;
                        EXCEPTION
                        WHEN ZERO_DIVIDE THEN
                        RETURN 01;
                        WHEN NO_DATA_FOUND THEN
                        RETURN NULL;
                        WHEN DUP_VAL_ON_INDEX THEN
                        RETURN 011;
                        END;
                    <strong>FUNCTION calcul_dobanda(p_sold INT, p_nr_contr contract.nr_contract%TYPE) RETURN INT IS</strong>
                    v_procent_d int;
                    BEGIN
                    SELECT dobanda into v_procent_d from contract where nr_contract=p_nr_contr;
                    RETURN p_sold*(v_procent_d /100)*to_char(LAST_DAY(SYSDATE),'dd')/360;
                    EXCEPTION
                    WHEN TOO_MANY_ROWS THEN
                    RETURN 011;
                    WHEN ZERO_DIVIDE THEN
                    RETURN 01;
                    WHEN PROGRAM_ERROR THEN
                    RETURN 012;
                    END;
                <strong>PROCEDURE rambursari( p_nr_contr contract.nr_contract%TYPE, p_suma Number, p_suma_rb Number, p_data_scr DATE, p_data_ramb DATE, p_dobanda Number,
                            p_dob_ramb Number, p_comision Number, p_com_ramb Number, p_sold_credit_ramas IN OUT Number) IS</strong>
                        v_sold int;
                        v_nr_contract  int;
                        v_nr_rata int;
                        e_not_insert EXCEPTION;
                        e_no_sold EXCEPTION;

                        BEGIN
                        SELECT sold INTO v_sold from cont WHERE id_cont=(SELECT id_cont from contract where nr_contract=p_nr_contr);
                        IF(v_sold>(p_suma_rb+p_dob_ramb+p_com_ramb)) THEN
                        SELECT max(nr_rata) into v_nr_rata from scadentar WHERE nr_contract=p_nr_contr;
                        IF v_nr_rata IS NOT NULL THEN
                            SELECT sold_credit_ramas into p_sold_credit_ramas from scadentar WHERE nr_contract=p_nr_contr and nr_rata=v_nr_rata;
                           v_nr_rata:=v_nr_rata+1;
                           p_sold_credit_ramas:=p_sold_credit_ramas-(p_suma_rb);
                           INSERT INTO scadentar VALUES (v_nr_rata, p_nr_contr, p_suma, p_suma_rb, p_data_scr, p_data_ramb, p_dobanda, p_dob_ramb, p_comision, p_com_ramb, p_sold_credit_ramas);

                        IF SQL%ROWCOUNT=0 THEN
                        RAISE e_not_insert;
                        ELSE
                        DBMS_OUTPUT.PUT_LINE('Rambursare cu succes!');
                        END IF;

                        ELSE
                         v_nr_rata:=1;
                          p_sold_credit_ramas:=p_sold_credit_ramas-(p_suma_rb);
                          INSERT INTO scadentar VALUES (v_nr_rata, p_nr_contr, p_suma, p_suma_rb, p_data_scr, p_data_ramb, p_dobanda, p_dob_ramb, p_comision, p_com_ramb, p_sold_credit_ramas);
                         IF SQL%ROWCOUNT=0 THEN
                             RAISE e_not_insert;
                           ELSE
                              DBMS_OUTPUT.PUT_LINE('Rambursare cu succes!');
                           END IF;

                        END IF;
                        ELSE
                        RAISE e_no_sold;
                        END IF;

                        EXCEPTION
                        WHEN e_no_sold THEN
                        DBMS_OUTPUT.PUT_LINE('SOLD INSUFICIENT PENTRU RAMBURSARE');
                        WHEN e_not_insert THEN
                        DBMS_OUTPUT.PUT_LINE('NO ROW WAS INSERTED');
                        WHEN NO_DATA_FOUND THEN
                            DBMS_OUTPUT.PUT_LINE('NO DATA FAUND');
                        WHEN TOO_MANY_ROWS THEN
                        DBMS_OUTPUT.PUT_LINE('Returneaza mai mult decat o inregistrare');
                        WHEN OTHERS THEN
                        DBMS_OUTPUT.PUT_LINE('ERROR');
                        END;

                        BEGIN
                        SELECT suma INTO g_sal_minim FROM evidenta_salariu where data_sal=(SELECT MAX(data_sal) FROM evidenta_salariu);

                        END;
                </pre>
                    <p>Se apeleaza blocurile din pachet</p>
                    <pre>
                        DECLARE
                        V_DATA1 DATE:=:V_DATA1;
                        v_nr_contract contract.nr_contract%TYPE:=:v_nr_contract;
                        v_suma_r  scadentar.suma_rata%TYPE:=:v_suma_r;
                        v_suma_ramb scadentar.suma_ramb%TYPE:=:v_suma_ramb;
                        v_dobanda  scadentar.dobanda%TYPE:=:v_dobanda;
                        v_dobanda_r  scadentar.dobanda_ramb%TYPE:=:v_dobanda_r ;
                        v_comision  scadentar.comision%TYPE:=:v_comision;
                        v_com_ramb  scadentar.comision_ramb%TYPE:=:v_com_ramb;
                        v_sold_credit_ramas  contract.suma_credit%TYPE;
                        BEGIN
                        select suma_credit into v_sold_credit_ramas from contract where nr_contract=v_nr_contract;
                        returnDetails_pkg.rambursari(v_nr_contract,v_suma_r,v_suma_ramb,V_DATA1,SYSDATE,v_dobanda,v_dobanda_r,v_comision,v_com_ramb,v_sold_credit_ramas);
                        DBMS_OUTPUT.PUT_LINE('Sold credit ramas: '|| v_sold_credit_ramas);
                        END;
                    </pre>
                    <p><i>P.S.</i> select suma_credit into v_sold_credit_ramas from contract where nr_contract=v_nr_contract; Dacă este prima rambursare, sold_credit_ramas reprezintă suma inițială de împrumut din tabela contract, altfel este suma ramasă după ultima rambursare.</p>
                    <button onclick="myFunction('img19')" class="btn-primary btn-block my-1">View</button>
                    <div id="img19" style="display: none;">
                        <p onclick="myCollapse('img19')">collapse</p>
                        <p class="text-center">Figure 19 Rezultatul dupa apelarea procedurii rambursari()</p>
                        <img src="{{asset('front_assets/images/poz19.png')}}" alt="Imagine" class="img-fluid width-auto">
                    </div>
                    <pre>DECLARE
                            v_nr_contr contract.nr_contract%TYPE:=:v_nr_contr;
                            v_result int;
                            begin
                            v_result:= returnDetails_pkg.rambursari(v_nr_contr);
                            IF(v_result=011) THEN
                            DBMS_OUTPUT.PUT_LINE('ERROR-DUP_VAL_ON_INDEX');
                            ELSIF(v_result IS NULL) THEN
                            DBMS_OUTPUT.PUT_LINE('NO DATA FOUND');
                            ELSIF(v_result =01) THEN
                            DBMS_OUTPUT.PUT_LINE('ZERO DIVIDE');
                            ELSE
                            DBMS_OUTPUT.PUT_LINE(v_result);
                            END IF;
                        End;
                        </pre>
                    <button onclick="myFunction('img20')" class="btn-primary btn-block my-1">View</button>
                    <div id="img20" style="display: none;">
                        <p onclick="myCollapse('img20')">collapse</p>
                        <p class="text-center">Figure 20 Rezultatul apelarii functiei rambursari()</p>
                        <img src="{{asset('front_assets/images/poz20.png')}}" alt="Imagine" class="img-fluid width-auto">
                    </div>
                </ol>
            </div>

        </div>
    </div>
@endsection
