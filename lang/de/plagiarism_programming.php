<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * The language strings for the english version for this plugin.
 *
 * @package    plagiarism_programming
 * @copyright  2019 Benedikt Schneider (@Nullmann)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die('Access to internal script forbidden');

// Einstellungen.
$string['pluginname'] = 'Quellcode Plagiarismus Plugin';
$string['programming'] = 'Programmieraufgabe';
$string['programmingexplain'] = 'Dies ist die Konfiguration für das Plagiaterkennungsplugin für Quellcode';
$string['use_programming'] = 'Das Plugin zur Plagiarismus-Erkennnung von Quellcode benutzen.';
$string['jplag'] = 'JPlag globale Konfiguration';
$string['jplag_username'] = 'JPlag Benutzername';
$string['jplag_password'] = 'JPlag Password';
$string['jplag_modify_account'] = 'JPlag-Konto ändern';
$string['moss'] = 'MOSS globale Konfiguration';
$string['moss_id'] = 'userid: ';
$string['moss_id_help'] = 'Suchen Sie die Zeile $userid=some number in der Antwort-E-Mail von MOSS und geben Sie diese Nummer in das Feld unten ein';
$string['moss_id_help_2'] = 'Oder kopieren Sie den Inhalt der E-Mail in dieses Feld und die userid wird extrahiert.';
$string['enable_global'] = 'Dieses Plugin für das gesamte Moodle aktivieren';
$string['enable_course'] = 'Dieses Plugin für einzelne Kurse und Kursbereiche aktivieren';

$string['proxy_config'] = 'Proxy-Konfiguration (falls vorhanden)';
$string['proxy_host'] = 'Proxy-Adresse';
$string['proxy_port'] = 'Proxy Port';
$string['proxy_user'] = 'Proxy Login';
$string['proxy_pass'] = 'Proxy Passwort';
$string['jplag_account_error'] = 'Fehler beim letzten Scan: Ungültiges JPlag-Konto - Bitte geben Sie einen richtigen Benutzernamen und das richtige Passwort an';
$string['jplag_account_expired'] = 'Fehler beim letzten Scan: Ihr Konto ist abgelaufen!';
$string['jplag_connection_error'] = 'Fehler beim letzten Scan: Kann keine Verbindung zum JPlag-Server herstellen - Bitte überprüfen Sie die Verbindung';
$string['moss_connection_error'] = 'Fehler beim letzten Scan: Kann keine Verbindung zum MOSS-Server auf Port 7690 herstellen - Bitte überprüfen Sie die Verbindung';
$string['proxy_connection_error'] = 'Fehler beim letzten Scan: Kann keine Verbindung zu MOSS über den angegebenen Proxy-Server herstellen';
$string['moss_account_error'] = 'Fehler beim letzten Scan: MOSS-Anmeldung ist ungültig. Bitte geben Sie eine gültige MOSS-Benutzerkennung in '
    .'Plugins -> Plagiatsuche -> Quellcode Plagiarismus Plugin an';
$string['moss_send_error'] = 'Beim Senden der Zuweisung an MOSS ist ein Fehler aufgetreten. '
    .'Bitte überprüfen Sie: Ihre Benutzerkennung, Ihre Server-Internetverbindung oder ob der Port 7690 zum Remote-Host gesperrt ist';
$string['save_config_success'] = 'Konfiguration gespeichert';
$string['username_missing'] = 'Bitte JPlag Benutzernamen angeben';
$string['password_missing'] = 'Bitte JPlag Passwort angeben';
$string['moss_userid_missing'] = 'Bitte MOSS-Benutzer-ID oder E-Mail angeben';
$string['account_instruction'] = 'Das Plugin verwendet MOSS und JPlag Engine im Hintergrund. Für die Nutzung dieser Services ist ein Konto erforderlich.';
$string['jplag_account_instruction'] = 'Wenn Sie kein JPlag-Konto haben, können Sie sich unter https://jplag.ipd.kit.edu/ registrieren';
$string['moss_account_instruction'] = 'Ein MOSS-Account kann per Mail an "moss@moss.stanford.edu registriert" werden. Anweisungen dazu finden Sie unter: ';
$string['moss_userid_notfound'] = 'Benutzer-ID wurde in der angegebenen E-Mail nicht gefunden';
$string['proxy_port_missing'] = 'Proxy-Port muss zusammen mit dem Host bereitgestellt werden';
$string['proxy_host_missing'] = 'Proxy host muss zusammen mit dem Port bereitgestellt werden';
$string['proxy_user_missing'] = 'Proxy-Login muss zusammen mit dem Passwort angegeben werden';
$string['proxy_pass_missing'] = 'Proxy-Passwort muss zusammen mit der Anmeldung angegeben werden';

// Formular.
$string['plagiarism_header'] = 'Quellcode Plagiaterkennung';
$string['programmingYN'] = 'Überprüfung der Codegleichheit';
$string['programming_language'] = 'Programmiersprache';
$string['scan_date'] = 'Scandatum';
$string['scan_date_finished'] = 'Scandatum (fertig)';
$string['new_scan_date'] = 'Neues Datum';
$string['detection_tools'] = 'Erkennungswerkzeuge';
$string['detection_tool'] = 'Erkennungswerkzeug';
$string['jplag'] = 'JPlag';
$string['moss'] = 'MOSS';
$string['auto_publish'] = 'Ähnlichkeitsbericht veröffentlichen';
$string['notification'] = 'Benachrichtigung anzeigen';
$string['notification_text'] = 'Benachrichtigungstext';
$string['notification_text_default'] = 'Diese Abgabe wird nach Code-Ähnlichkeit gescannt';
$string['additional_code'] = 'Zusätzlicher Code zum Vergleich (Nur .zip oder .rar!)';

$string['programmingYN_hlp'] = '';
$string['programmingYN_hlp_help'] = 'Plagiaterkennung von Quellcode für diese Aufgabe aktivieren';
$string['programmingLanguage_hlp'] = '';
$string['programmingLanguage_hlp_help'] = 'Die in dieser Zuordnung verwendete Programmiersprache (erforderlich). '
    .'Nicht jede Sprache wird von beiden Erkennungswerkzeugen unterstützt';
$string['detection_tools_hlp'] = '';
$string['detection_tools_hlp_help'] = 'Wählen Sie die zu verwendenden Erkennungswerkzeuge aus. Jedes Werkzeug verwendet einen anderen Abgleichalgorithmus. '
    .'Sie können beide auswählen. Ein Tool unterstützt jedoch möglicherweise einige Sprachen nicht (in diesem Fall ist es ausgegraut)';
$string['date_selector_hlp'] = '';
$string['date_selector_hlp_help'] = 'Wählen Sie das Datum, an dem die Beiträge gescannt werden sollen. Sie können mehrere Termine auswählen. '
    .'Alternativ können Sie den Scanvorgang auch manuell auslösen, indem Sie die Schaltfläche "Scannen" auf der Abgabeübersicht drücken';
    $string['date_selector_finished_hlp'] = '';
    $string['date_selector_finished_hlp_help'] = 'Dieser Scan wurde bereits beendet und kann nicht mehr verändert werden. Den Bericht können Sie in der Bewertungs-Ansicht einsehen.';
$string['auto_publish_hlp'] = '';
$string['auto_publish_hlp_help'] = 'Den Studenten erlauben, den Plagiatbericht zu sehen'
    .'Sie können die Ähnlichkeitsprozente sehen, aber weder den Code noch die Namen anderer Studierender. Außerdem werden markierte Paare nicht rot oder grün hinterlegt.';
$string['see_mark'] = 'Zeige Markierungen';
$string['see_mark_hlp'] = '';
$string['see_mark_hlp_help'] = 'Studenten dürfen einsehen, ob ein Paar als verdächtig markiert wurde oder nicht';
$string['notification_hlp'] = '';
$string['notification_hlp_help'] = 'Benachrichtigen Sie die Studierenden, dass seine Einreichung auf Plagiate Überprüft wird';
$string['programming_language_missing'] = 'Programmiersprache ist erforderlich';
$string['notification_text_hlp'] = '';
$string['notification_text_hlp_help'] = 'Setzt den anzuzeigenden Benachrichtigungstext';
$string['additional_code_hlp'] = '';
$string['additional_code_hlp_help'] = 'Anderen Code zum Vergeleich uploaden (z.B. Code aus dem Internet oder frühere Aufgaben). '
    .'Es werden nur Zip- und Rar-Dateien unterstützt. Eine komprimierte Datei muss eine Anzahl von Verzeichnissen oder komprimierten Dateien enthalten, die jeweils einer Zuordnung entsprechen';

$string['jplag_credential_missing'] = "Achtung: Das JPlag-Konto wurde nicht bereitgestellt";
$string['moss_credential_missing'] = "Achtung: Das MOSS-Konto wurde nicht bereitgestellt";
$string['credential_missing_instruction'] = 'Bitte geben Sie die gewünschte Anmeldedaten in Administrator -> Plugins -> Plagiatsuche -> Quellcode Plagiarismus Plugin ein';
$string['no_tool_selected_error'] = 'Sie müssen mindestens ein Werkzeug auswählen';
$string['invalid_submit_date_error'] = 'Das Einreichungsdatum darf nicht in der Vergangenheit liegen.';
$string['pending'] = 'Nicht gestartet';
$string['extract'] = 'Extrahieren der Zuordnung';
$string['pending_start'] = 'Vorbereitung auf den Versand der Abgabe';
$string['uploading'] = 'Senden der Zuordnung';
$string['scanning'] = 'Suche nach Ähnlichkeiten';
$string['downloading'] = 'Herunterladen von Ähnlichkeiten';
$string['scanning_done'] = 'Scannen auf dem Server beendet';
$string['inqueue_on_server'] = 'Warten in der Serverwarteschlange';
$string['parsing_on_server'] = 'Eingaben parsen';
$string['generating_report_on_server'] = 'Generierung des Berichts';
$string['error_bad_language'] = 'Fehler: Falsche Programmiersprache';
$string['error_not_enough_submission'] = 'Nicht genügend Einreichungen zum Scannen. Dies ist wahrscheinlich zu viele Einsendungen können nicht analysiert werden. '
        .'Bitte überprüfen Sie Ihre Sprachkonfiguration';
$string['jplag_cancel_error'] = 'Die Übermittlung kann nicht abgebrochen werden.';

$string['start_scanning'] = 'Jetzt scannen';
$string['rescanning'] = 'Neu scannen';
$string['no_tool_selected'] = 'Kein Detektor wurde ausgewählt. Bitte wählen Sie mindestens einen unter MOSS und JPlag';
$string['not_enough_submission'] = 'Nicht genügend Einreichungen zum Scannen! Es werden mindestens 2 benötigt';
$string['scheduled_scanning'] = 'Der nächste Scan ist geplant für';
$string['no_scheduled_scanning'] = 'Es ist kein Scan geplant!';
$string['latestscan'] = 'Letzter Scan erfolgte um ';
$string['manual_scheduling_help'] = 'Wenn Sie das Scannen sofort auslösen wollen (bei verspäteten Einreichungen, Verlängerung, ...), '
    .'bitte klicken Sie auf den untenstehenden Button!';
$string['credential_not_provided'] = 'Zugansgdaten sind nicht eingegeben. Bitte geben Sie diese Informationen in'
    .'Administrator -> Plugin -> Plagiatsuche -> Quellcode Plagiarismus Plugin ein';
$string['unexpected_error_extract'] = 'Beim Extrahieren der Zuweisungen ist ein unerwarteter Fehler aufgetreten! Dies kann auf beschädigte Daten oder nicht unterstützte Formate zurückzuführen sein';
$string['unexpected_error_upload'] = 'Ein unerwarteter Fehler ist beim Senden der Anweisungen aufgetreten! Dies kann auf einen Verbindungsabbruch oder einen Ausfall des Remote-Servers zurückzuführen sein'
    .' Bitte versuchen Sie es später noch einmal!';
$string['unexpected_error_download'] = 'Ein unerwarteter Fehler ist beim Herunterladen und Parsen des Ergebnisses aufgetreten! Dies kann daran liegen, dass die Verbindung unterbrochen oder die Daten beschädigt wurden'
    .' Bitte versuchen Sie es später noch einmal!';
$string['general_user_error'] = 'Fehler aufgetreten aufgrund beschädigter Berichtsdaten';
$string['scanning_in_progress'] = 'Scannen kann je nach Serverlast sehr lange dauern! Bitte zögern Sie nicht, von dieser Seite weg zu navigieren';
$string['unexpected_error'] = 'Ein unerwarteter Fehler ist aufgetreten! Bitte kontaktieren Sie den Administrator!';
$string['invalid_file_type'] = 'Einreichungen müssen Dateierweiterungen besitzen';

// Optionen fuer die Anzeige der Ergebnisse.
$string['option_header'] = 'Optionen';
$string['threshold'] = 'Untere Schwelle (%)';
$string['similarity_type'] = 'Gleichheitstyp';
$string['Detektoren'] = 'Detektor';
$string['display_mode'] = 'Darstellungsart';
$string['display_group'] = 'Matrix';
$string['display_table'] = 'Sortierte Tabelle';
$string['version'] = 'Historie';
$string['similarity_history'] = 'Historie der Ähnlichkeitsrate';
$string['submit'] = 'Filter';
$string['showHideLabel'] = 'Plagiatoptionen anzeigen';

$string['permission_denied'] = "Sie haben keine Berechtigung, diese Seite zu sehen";
$string['report_not_available'] = 'Keine Berichte verfügbar';

$string['lower_threshold_hlp'] = '';
$string['lower_threshold_hlp_help'] = 'Zeigt nur die Paare an, deren Ähnlichkeitsrate über diesem Wert liegt';

$string['rate_type_hlp'] = '';
$string['rate_type_hlp_help'] = 'Da zwei Zuweisungen wesentlich unterschiedliche LÄngen haben können, wird das Verhältnis der ähnlichen Teile '
    .'auch unterschiedlich sein. "Durchschnittliche Gleichheit" nimmt die Durchschnittsrate der beiden als die Ähnlichkeitsrate des Paares, '
    .'während "Maximale Ähnlichkeit" die maximale nimmt';

$string['tool_hlp'] = '';
$string['tool_hlp_help'] = 'Wählen Sie das Werkzeug aus, um das Ergebnis anzuzeigen';
$string['display_mode_hlp'] = '';
$string['display_mode_hlp_help'] = 'Wählen Sie den Anzeigemodus aus. Der Modus "Matrix" zeigt alle Studierende, die mit diesem.'
    .'Studierenden ähnlich sind in einer Reihe. "Sortierte Tabelle" zeigt eine Liste von Paaren mit absteigender Ähnlichkeitsrate';
$string['version_hlp'] = '';
$string['version_hlp_help'] = 'Siehe den Bericht über frühere Scans';
$string['pair'] = 'Anzahl an Paaren';

// Im Bericht (view.php).
$string['yours'] = 'Eigene Abgabe';
$string['another'] = 'Andere Abgabe';
$string['chart_legend'] = 'Ähnlichkeitsverteilung des gesamten Kurses';
$string['result'] = 'Ergebnis des Ähnlichkeitsscans';
$string['comparison_title'] = 'Ähnlichkeiten';
$string['comparison'] = 'Vergleich';
$string['legend'] = 'Legende';

$string['plagiarism_action'] = 'Aktion';
$string['mark_select_title'] = 'Dieses Paar markieren als';
$string['show_similarity_to_others'] = 'Zeige Ähnlichkeit von "{student}" mit anderen Schülern';
$string['history_char'] = 'Ähnlichkeitshistorie anzeigen';

// Benachrichtigung.
$string['high_similarity_warning'] = 'Deine Aufgabe wurde als Ähnlich mit einigen anderen markiert';
$string['working_scan'] = 'Letzter Scan ohne Fehler';
$string['stanford_link'] = 'Original Bericht auf stanford.edu';
$string['max_similarity'] = 'Maximale Ähnlichkeit';
$string['avg_similarity'] = 'Durchschnittliche Ähnlichkeit';
$string['suspicious'] = 'verdächtig';
$string['nonsuspicious'] = 'nicht verdächtig';
$string['marked_as'] = 'Markiert als';
$string['no_similarity'] = 'Keine Ähnlichkeit, neue Abgabe oder Fehler beim Scannen';
$string['error_falseresponse'] = '(Moss) Server Antwort war false. Sie müssen erneut einen Scan starten, außer dies ist ein task.';

$string['scanning_complete_email_notification_subject'] = '{$a->course_short_name} {$a->assignment_name}: Ähnlichkeitsprüfung verfügbar';
$string['scanning_complete_email_notification_body_html'] = 'Sehr geehrte/r {$a->recipientname}, <br/>'
.'Dies ist eine Benachrichtigung, dass das Scannen von Code-Ähnlichkeiten von "{$a->assignment_name}" in {$a->course_name}'
.'um {$a->time} beendet wurde.'
.'Sie können auf den Ähnlichkeitsbericht zugreifen, indem Sie diesem Link folgen: <a href="{$a->report_link}">{$a->report_link}</a>.';
$string['scanning_complete_email_notification_body_txt'] = 'Sehr geehrte/r {$a->recipientname},'
.'Dies ist eine Benachrichtigung, dass das Scannen von Code-Ähnlichkeiten von "{$a->Assignment_name}" in {$a->course_name}'
.'um {$a->time} beendet wurde.'
.'Sie können auf den Ähnlichkeitsbericht zugreifen, indem Sie diesem Link folgen: {$a->report_link}';

$string['similarity_report'] = 'Ähnlichkeitsbericht';
$string['include_repository'] = 'Zusätzlichen Code inkludieren';
$string['course_select'] = 'Kurse mit Codeplagiatsprüfung auswählen';
$string['by_name'] = 'Nach Name';
$string['search'] = 'Suche';
$string['search_by_category'] = 'Kurssuche nach Kategorie';

// Capabilites, Berechtigungen.
$string['programming:changesettings'] = 'Das Plugin in den Einstellungen einer Abgabe aktivieren und die Einstellungen ändern dürfen';
$string['programming:manualscan'] = 'Manuell einen Scan starten, indem der "Scan"-Button in der grading-Übersicht gedrückt wird';
$string['programming:markpairs'] = 'Zwei Paare als verdächtig oder nicht verdächtig markieren';
$string['caperror_changesettings'] = 'Sie haben nicht die Berechtigung, die Einstellungen dieses Plugins zu ändern.';
$string['caperror_manualscan'] = 'Sie haben nicht die Berechtigung, einen Plagiat-Scan manuell auszulösen.';
$string['caperror_markpairs'] = 'Sie haben nicht die Berechtigung, Paare als verdächtig oder nicht verdächtig zu markieren.';

// Task API.
$string['task_name'] = 'Sendet geplante Scans an Moss und speichert das Ergebnis.';

// Privacy API.
$string['privacy:metadata:plagiarism_programming_files'] = 'Der Quellcode jedes Studenten wird in dataroot/temp/plagiarism_report/<cmid>/<userid>/<source_code> extrahiert.'
.'und dann in moodledata/temp/plagiarism_report/moss<cmid><version>/<userid> gespeichert, in welchem die letzten 20 Versionen gespeichert sind.';

$string['privacy:metadata:plagiarism_programming_reslt'] = 'In der Ergebnistabelle wird jeder Vergleich jedes MOSS-Durchlaufs gespeichert';
$string['privacy:plagiarism_programming_reslt:student1_id'] = 'Student 1 moodle Nutzer id';
$string['privacy:plagiarism_programming_reslt:student2_id'] = 'Student 2 moodle Nutzer id';
$string['privacy:plagiarism_programming_reslt:similarity1'] = 'Prozentsatz der übereinstimmenden Zeilen vom Code des Studenten 1 zum Code des Studenten 2';
$string['privacy:plagiarism_programming_reslt:similarity2'] = 'Prozentsatz der übereinstimmenden Zeilen vom Code des Studenten 2 zum Code des Studenten 1';
$string['privacy:plagiarism_programming_reslt:comparison'] = 'Link zum Unter-HTML der Moss-Seite (z.B. http://moss.stanford.edu/results/XXXXXX/match0.html)';
$string['privacy:plagiarism_programming_reslt:comments'] = 'Kommentare über die Ähnlichkeit';
$string['privacy:plagiarism_programming_reslt:mark'] = 'Ob das Paar als verdächtig oder nicht verdächtig markiert wurde';

$string['privacy:metadata:moss_stanford'] = 'Der Quellcode jedes Studenten wird an den MOSS-Webservice gesendet, siehe http://theory.stanford.edu/~aiken/moss/';
$string['privacy:metadata:moss_stanford:userid'] = 'Die Namen der einzelnen Ordner sind die Studenten-IDs';
$string['privacy:metadata:moss_stanford:source_code'] = 'In jedem dieser Ordner wird der hochgeladene Quellcode an MOSS gesendet';

$string['privacy:path'] = 'Quellcode-Plagiarismus-Plugin';