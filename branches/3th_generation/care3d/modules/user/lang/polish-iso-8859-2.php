<?php
/*
  Language-file polish-iso-8859-2.php
  Author: Tomasz Osmialowski <ichtis@gmail.com>
*/
$words = array(

/* Account MGR */

    // title
    'My Account'                   => 'Moje konto',
    'My Profile :: Edit'           => 'M�j profil :: edycja',

    // summary form (admin template)
    'Role'                         => 'Rola',
    'Date Registered'              => 'Data rejestracji',
    'Last Login'                   => 'Ostatnie logowanie',
    'first login in progress'      => 'pierwsza sesja',
    'Current IP Address'           => 'Adres IP',
    'change password'              => 'zmie� has�o',
    // + user template
    'My Profile'                   => 'M�j Profil',
    'Preferences'                  => 'Konfiguracja',
    'Password'                     => 'Has�o',
    'edit preferences'             => 'konfiguracja',
    'view profile'                 => 'poka� profil',
    'No results found for that ID' => 'Nie znaleziono wynik�w o tym ID',

    // profile form (admin template)
    'Personal Details'        => 'Szczeg�y',
    'Username'                => 'U�ytkownik',
    'First Name'              => 'Imi�',
    'Last Name'               => 'Nazwisko',
    'Contact'                 => 'Kontakt',
    'Location'                => 'Lokalizacja',
    'Address 1'               => 'Adres 1',
    'Address 2'               => 'Adres 2',
    'Address 3'               => 'Adres 3',
    'City'                    => 'Miasto',
    'Country'                 => 'Pa�stwo',
    'Telephone'               => 'Telefon',
    'Mobile'                  => 'Tel. kom�rkowy',
    'County/State/Province'   => 'Wojew�dztwo',
    'ZIP/Postal Code'         => 'Kod pocztowy',
    // + user template
    'Company'                 => 'Nazwa Firmy',
    'edit these values'       => 'Edycja',

    // edit form
    'edit user'          => 'Edycja u�ytkownika',
    'Confirm Password'   => 'Potwierd� has�o',
    'Organisation name'  => 'Nazwa organizacji',
    'Is Active?'         => 'Czy aktywny?',
    'Security'           => 'Bezpiecze�stwo',
    'Security question'  => 'Pytanie bezpiecze�stwa',
    'Answer'             => 'Odpowied�',

    'aSecurityQuestions' => array(
        0 => '',
        1 => 'Imi� ulubionego zwierz�cia',
        2 => 'Wa�na data (dd.mm.rrrr)',
        3 => 'Wa�ne miejsce',
        4 => 'Nazwisko panie�skie matki',
        5 => 'Ulubiony film',
        6 => 'Ulubiona piosenka',
        7 => 'Ulubiony nap�j'
    ),

    // messages
    'profile successfully updated' => 'Szczeg�y profilu zosta�y poprawnie zapisane',

    // validate
    'You must enter a username'             => 'Musisz poda� nazw� u�ytkownika',
    'username min length'                   => 'Nazwa u�ytkownika musi zawiera� wi�cej ni� 5 alfanumerycznych znak�w bez odst�p�w', // 'Your username must be alphanumeric with at least 5 characters and no spaces',

    'You must enter at least address 1'     => 'Musisz poda� co najmniej jeden adres',
    'You must enter your city'              => 'Musisz poda� miasto',
    'You must enter your state/province'    => 'Musisz poda� wojew�dztwo',

    'Please enter a company name'           => 'Prosz� poda� nazw� firmy',
    'You must enter your ZIP/Postal Code'   => 'Musisz poda� kod pocztowy',
    'You must enter your province'          => 'Musisz poda� wojew�dztwo',
    'You must enter your country'           => 'Musisz poda� pa�stwo',
    'Your email is not correctly formatted' => 'Z�y format emaila',
    'You must enter your email'             => 'Musisz poda� email',
    'You must choose a security question'   => 'Musisz wybra� pytanie bezpiecze�stwa',
    'Please enter a telephone number'       => 'Musisz poda� numer telefonu',
    'You must provide a security answer'    => 'Musisz poda� odpowied� na wybrane pytanie bezpiecze�stwa',


/* Register MRG */

    // title
    'Register' => 'Rejestracja',

    // validation
    'You must enter a password'                                    => 'Musisz poda� has�o',
    'Please confirm password'                                      => 'Prosz� potwierdzi� has�o',
    'Password must be between 5 to 10 characters'                  => 'Has�o musi zawiera� od 5 do 10 znak�w',
    'Passwords are not the same'                                   => 'Has�a nie s� takie same',
    'This email already exist in the DB, please choose another'    => 'Podany email ju� istnieje w bazie danych, prosz� poda� inny',
    'This username already exist in the DB, please choose another' => 'Podana nazwa u�ytkownika ju� istnieje w bazie danych, prosz� poda� inn�',

    // messages
    'user successfully registered' => 'Rejestracja przebieg�a poprawnie. Prosz� sprawdzi� sw�j email z pro�b� o potwierdzenie has�a',

    // XXX mail templates here


/* Password MRG */

    // titles
    'Retrieve password' => 'Odzyskaj has�o',

    // list
    'Enter the email address you registered with' => 'Podaj adres email podany przy rejestracji',
    'retrieve' => 'odzyskaj',


/* UserPassword */

    // titles
    'Change Password' => 'Zmiana has�a',

    // form
    'Original password'  => 'Aktualne has�o',
    'New password'       => 'Nowe has�o',
    'Confirm'            => 'Potwierd�',
    'Notify me by email' => 'Prze�lij na email',

    // messages
    'Password updated successfully' => 'Has�o zosta�o zmienione',

    // validation
    'You must enter your original password'                 => 'Musisz poda� aktualne has�o',
    'You must enter a new password'                         => 'Musisz poda� nowe has�o',
    'You have entered your original password incorrectly'   => 'Podane aktualne has�o jest niepoprawne',


/* Login MRG */

    // title
    'Login' => 'Zaloguj',

    // form
    'Authorisation Required' => 'Wymagana autoryzacja dost�pu',

    // validation
    'username/password not recognized' => 'Podana nazwa u�ytkownika i has�o nie zosta�y poprawnie rozpoznane, prosz� spr�bowa� ponownie', // 'Your username/password combination has not been recognized, please try again',

    // XXX: other messages are defined in default lang file for now :/


/* UserPreference MGR */

    // title
    'User Preferences' => 'Konfiguracja u�ytkownika',

    // form (admin template)
    'Theme'                                        => 'Szablon',
    'Change what this site looks like'             => 'Okre�la wygl�d ca�ego serwisu',
    'Date format'                                  => 'Format daty',
    'UK format is dd/mm/yyyy and US is mm/dd/yyyy' => 'Format UK to dd/mm/rrrr, a US  to mm/dd/rrrr',
    'Interface language'                           => 'J�zyk interfejsu',
    'Session timeout'                              => 'Czas trwania sesji',
    'Session timeout tooltip'                      => 'Dla bezpiecze�stwa czas trwania sesji b�dzie trwa�, a� do zamkni�cia przegl�darki, jednak mo�esz okre�li� maksymalny czas jej trwania', // 'As a security measure your session will end once you close the browser, however, you can set the max duration of your session within this time',
    'Locale'                                       => 'Lokalizacja',
    'Timezone'                                     => 'Strefa czasowa',
    'Results per page'                             => 'Ilo�� wynik�w na stronie',
    'Show execution times?'                        => 'Pokaza� czas wykonania skryptu?',
    // + user template
    'General'                                      => 'Og�lne',

    // messages
    'details successfully updated' => 'Dane zosta�y zapisane',


/* Profile MGR */

    // titile
    'User Profile' => 'Profil u�ytkownika',

    // form
    'Real Name'                => 'Nazwisko i imi�',
    'Lives in'                 => 'Mieszka w',
    'Member Since'             => 'Uczestnik od',
    'none given'               => 'b/d',
    'Posting Stats for User'   => 'Ustaw status dla u�ytkownika',
    'Total Articles'           => 'Wszystkich artyku��w',
    'Total Comments'           => 'Wszystkich komentarzy',
    'coming soon ...'          => 'wkr�tce dost�pne ...',

     // messaging
    'back to contacts' => 'powr�t do kontakt�w',
    'Message'          => 'Wiadomo��',
    'send message'     => 'wy�lij wiadomo��',
    'Contacts'         => 'Kontakty',
    'add to contacts'  => 'dodaj do kontakt�w',


/* OrgPreferences MGR */

    // title
    'Organisation Preferences' => 'Konfiguracja organizacji',

    // form
    'Preferences for org' => 'Konfiguracja organizacji',

    // messages
    'org details successfully updated' => 'Szczeg�y organizacji zosta�y zmienione',


/* OrgType MGR */

    // titles
    'OrgType Manager'           => 'Menad�er typu organizacji',
    'OrgType Manager :: Browse' => 'Menad�er typu organizacji :: Podgl�d',
    'OrgType Manager :: Add'    => 'Menad�er typu organizacji :: Dodaj',
    'OrgType Manager :: Edit'   => 'Menad�er typu organizacji :: Edycja',

    // list
    'Organisation Type list'    => 'Lista typ�w organizacji',
    'Add organisation type'     => 'Dodaj typ organizacji',
    'organisation type'         => 'typ organizacji',
    'Be Careful!'               => 'B�d� ostro�ny!',

    // form
    'New organisation'          => 'Nowa organizacja',
    'New organisation type'     => 'Nowy typ organizacji',
    'Edit organisation'         => 'Edycja organizacji',

    // validation
    'You must enter an organisation type name' => 'Musisz poda� nazw� organizacji',

    // messages
    'No data was updated'                             => 'Brak danych do zmiany',
    'Org type(s) deleted successfully'                => 'Typ organizacji zosta� usuni�ty',
    'Organisation type saved successfully'            => 'Typ organizacji zosta� zapisany',
    'Organisation type has been updated successfully' => 'Typ organizacji zosta� zmieniony',
    'No organisations found' => 'Nie znaleziono organizacji',


/* Org MGR */

    // title
    'Organisation Manager'           => 'Menad�er Organizacji',
    'Organisation Manager :: Browse' => 'Menad�er Organizacji :: Podgl�d',
    'Organisation Manager :: Add'    => 'Menad�er Organizacji :: Dodaj',
    'Organisation Manager :: Edit'   => 'Menad�er Organizacji :: Edycja',

    // list
    'Organisation list'    => 'Lista organizacji',
    'Website'              => 'Strona www',
    'change'               => 'zmie�',
    'organisation'         => 'organizacja',

    // form
    'New organisation'     => 'Nowa organizacja',
    'Edit organisation'    => 'Edycja organizacji',
    'Details'              => 'Szczeg�y',
    'Description'          => 'Opis',
    'Parent Org'           => 'Nadrz�dna organizacja',
    'Default Role'         => 'Standardowa rola',

    // validation
    'You must enter an organisation name' => 'Musisz poda� nazw� organizacji',

    // messages
    'organisation successfully added'                                                     => 'Organizacja zosta�a dodana',
    'The selected organisation(s) have successfully been deleted'                         => 'Zaznaczone organizacje zosta�y usuni�te',
    'The selected organisation cannot be deleted because there are users relating to it'  => 'Zaznaczone %s organizacje nie zosta�y usuni�te, bo istnij� u�ytkownicy przy��czeni do niej!',
    'The organisation has successfully been updated'                                      => 'Organizacja zosta�a zmieniona',
    'The organisation has successfully been updated, no data changed'                     => 'Organizacja zosta�a zmieniona, bez zmiany danych',


/* Preference MGR */

    // titles
    'Preference Manager'           => 'Menad�er Preferencji',
    'Preference Manager :: Browse' => 'Menad�er Preferencji :: Podgl�d',
    'Preference Manager :: Add'    => 'Menad�er Preferencji :: Dodaj',
    'Preference Manager :: Edit'   => 'Menad�er Preferencji :: Edycja',

    // list
    'Default value' => 'Standardowa warto��',
    'preference'    => 'preferencja',

    // form
    'New preference'     => 'Nowa preferencja',
    'Editing preference' => 'Edycja preferencji',

    // validation
    'You must enter a default value'   => 'Musisz poda� standardow� warto��',
    'You must enter a preference name' => 'Musisz poda� nazw� preferencji',

    // messages
    'pref successfully deleted' => 'Preferencja zosta�a wykasowana',
    'pref successfully updated' => 'Preferencja zosta�a zmieniona',
    'pref successfully added'   => 'Preferencja zosta�a dodana',


/* Permission MGR */

    // titles
    'Permission Manager'                    => 'Menad�er Uprawnie�',
    'Permission Manager :: Browse'          => 'Menad�er Uprawnie� :: Podgl�d',
    'Permission Manager :: Add'             => 'Menad�er Uprawnie� :: Dodaj',
    'Permission Manager :: Edit'            => 'Menad�er Uprawnie� :: Edycja',
    'Permission Manager :: Detect & Add'    => 'Menad�er Uprawnie� :: Wykryj i dodaj',
    'Permission Manager :: Detect Orphaned' => 'Menad�er Uprawnie� :: Wykryj osierocone',

    // list
    'New permission'           => 'Nowe uprawnienie',
    'Editing permission'       => 'Edycja uprawnie�',
    'detect & add permissions' => 'wykryj i dodaj',
    'remove orphaned'          => 'usu� osierocone',
    'filter by module'         => 'filtruj wg modu�u',
    'all'                      => 'wszystkie',
    'permission'               => 'uprawnienie',

    // add / edit form
    'Module'                   => 'Modu�',

    // detect perms / remove orphaned
    'Detected Perms'             => 'Wykryj uprawnienia',
    'Detected Orphaned Perms'    => 'Wykryj osierocone uprawnienia',
    'orphaned perms description' => 'Wy�wietla uprawnienia zapisane w bazie, ale kt�re nie istniej� w modu�ach.', // 'The listed permissions were detected in the database, but do not exist in the modules.',
    'detected perms description' => 'Wy�wietla uprawnienia wykryte w modu�ach, ale kt�re nie zosta�y dodane jeszcze do bazy.', // 'The listed permissions were detected in the modules, but have not been added to the system yet.',

    // validation
    'You must enter a permission name' => 'Musisz poda� nazw� uprawnienia',

    // messages
    'perm already defined'                      => 'Uprawnienie ju� zosta�o zdefiniowane',
    'perm successfully added'                   => 'Uprawnienia zosta�o dodane',
    'perm(s) successfully added'                => 'Uprawnienia zosta�y dodane',
    'perm successfully deleted'                 => 'Uprawnienia zosta�y usuni�te',
    'perm successfully updated'                 => 'Uprawnienia zosta�y zmienione',

/* Role MGR */

    // titles
    'Role Manager'                => 'Menad�er R�l',
    'Role Manager :: Browse'      => 'Menad�er R�l :: Podgl�d',
    'Role Manager :: Add'         => 'Menad�er R�l :: Dodaj',
    'Role Manager :: Edit'        => 'Menad�er R�l :: Edycja',
    'Role Manager :: Permissions' => 'Menad�er R�l :: Uprawnienia',

    // list
    'New Role'   => 'Nowa rola',
    'duplicate'  => 'powiel',
    'role'       => 'rola',
    'permission' => 'uprawnienie',

    // add / edit / perms assignment
    'Editing role'                        => 'Edycja r�l',
    'Changing permission assignments for' => 'Zmiana uprawnie� przypisanych dla',
    'Remaining permissions'               => 'Pozosta�e uprawnienia',
    'Selected permissions for'            => 'Zaznaczone uprawnienia dla',
    'remove'                              => 'usu�',

    // validation
    'You must enter a role name' => 'Musisz poda� nazw� roli',

    // messages
    'role successfully added'                                                             => 'Rola zosta�a dodana',
    'role successfully updated'                                                           => 'Rola zosta�a zmieniona',
    'role successfully deleted'                                                           => 'Rola zosta�a usuni�ta',
    'role successfully deleted but please note, admin/unassigned roles cannot be deleted' => 'Rola zosta�a usuni�ta, ale prosz� zauwa�y�, �e usuni�cie roli administratora nie jest mo�liwe',
    'role successfully duplicated'                                                        => 'Rola zosta�a powielona',
    'role assignments successfully updated'                                               => 'Przypisanie roli zosta�o zmienione',


/* UserSearch MGR */

    // titles
    'User Manager :: Search' => 'Menad�er u�ytkownika :: Wyszukiwanie',

    // list
    'Search Criteria' => 'Kryteria wyszukiwania',
    'Role name'       => 'Nazwa roli',
    'User ID'         => 'ID u�ytkownika',
    'Organisation'    => 'Organizacja',
    'Register Date'   => 'Data rejestracji',

    // validation
    'You must select a valid date' => 'Musisz poda� poprawnie dat�',
    'You must select a date'       => 'Musisz wybra� dat�',


/* UserImport MGR */

    // titles
    'User Import Manager' => 'Menad�er importu u�ytkownik�w',

    // list
    'userfile'                                                         => 'Wprowad� plik',
    'Use the document manager to upload CSV files.'                    => 'U�yj menad�er dokument�w do przes�ania plik�w CSV.',
    'Import users into selected organisation.'                         => 'Importuj u�ytkownik�w do wybranej organizacji.',
    'User will be assigned to selected role.'                          => 'U�ytkownik zosta� przypisany do wybranej roli.',
    'You should first upload at least one csv file in your upload dir' => 'Powiniene� najpierw przes�a� co najmniej jeden plik CSV do przes�ania',

    // validation
    'Please select a file.'              => 'Prosz� wybra� plik.',
    'Please select the organisation'     => 'Prosz� wybra� organizacj�',
    'Please select the role'             => 'Prosz� wybra� rol�',


/* User MGR */

    // titles
    'User Manager'                     => 'Menad�er u�ytkownik�w',
    'User Manager :: Browse'           => 'Menad�er u�ytkownik�w :: Przegl�d',
    'User Manager :: Login Data'       => 'Menad�er u�ytkownik�w :: Dane logowania',
    'User Manager :: Edit'             => 'Menad�er u�ytkownik�w :: Edycja',
    'User Manager :: Edit permissions' => 'Menad�er u�ytkownik�w :: Edycja uprawnie�',
    'User Manager :: Add'              => 'Menad�er u�ytkownik�w :: Dodaj',
    'User Manager :: Reset password'   => 'Menad�er u�ytkownik�w :: Resetuj has�o',
    'User Manager :: Change status'    => 'Menad�er u�ytkownik�w :: Zmie� status',

    // list
    'New User'             => 'Nowy u�ytkownik',
    'Search'               => 'Wyszukaj',
    'Import users'         => 'Importuj u�ytkownik�w',
    'User list'            => 'Lista u�ytkownik�w',
    'user(s) found'        => 'znaleziono u�ytkownik�w',
    'clear search'         => 'wyczy�� wyszukiwanie',
    'Logins'               => 'Logowania',
    'list'                 => 'lista',
    'Change status'        => 'Zmie� status',
    'No users found'       => 'Nie znaleziono u�ytkownik�w',
    'Synchronise'          => 'Synchronizuj',
    '(each users current)' => '(ka�dego u�ytkownika do wybranej roli)',
    'sync perms with role' => 'synchronizuj uprawnienia',
    'add missing perms'    => 'dodaj brakuj�ce uprawnienia',
    'remove extra perms'   => 'usu� dodatkowe uprawnienia',
    'complete sync'        => 'pe�na synchronizacja',

    // add / edit
    'add user'             => 'dodaj u�ytkownika',
    'check if active'      => 'zaznacz, je�li aktywny',

    // login data
    'Connection list'      => 'Lista po��cze�',
    'Login Time'           => 'Czas logowania',
    'Remote IP'            => 'Adres IP',
    'Are you sure?'        => 'Czy jeste� pewien?',

    // status change
    'Disable Now'          => 'Wy��cz teraz',
    'Enable Now'           => 'W��cz teraz',
    'active'               => 'aktywny',
    'disabled'             => 'wy��czony',
    'Changing status for'  => 'Zmie� status dla',
    'Current status is'    => 'Obecny status to',
    'Enable user'          => 'Uaktywnij u�ytkownika',
    'Disable user'         => 'Wy��cz u�ytkownika',
    'Notify user'          => 'Powiadom u�ytkownika emailem',

    // reset
    'Reset password now'                   => 'Resetuj has�o teraz',
    'Resetting password for'               => 'Resetuj has�o dla',
    'Reset password info'                  => 'Pami�taj, je�eli resetujesz has�o dla administratora, musisz by� pewny poprawno�ci adresu email (mo�esz to zrobi� edytuj�c dane administratora), oraz �e system ma poprawnie skonfigurow� wysy�k� emaili.', // 'Remember, if you\'re resetting the password for the admin user, make sure you correctly specify the email address the new password will go to (hit "edit" for the admin user), and that your system is correctly setup to send and receive email.',

    // change permissions
    'for user id'            => 'dla u�ytkownika o ID',
    'Select a module'        => 'Zaznacz modu�',

    // messages
    'user successfully added'              => 'U�ytkownik zosta� dodany',
    'Deleted successfully'                 => 'Zaznaczone wpisy zosta�y usuni�te',
    'Status changed successfully'          => 'Status zosta� zmieniony',
    'user successfully deleted'            => 'Zaznaczeni u�ytkownicy zostali usuni�ci',
    'The user has been successfully added' => 'U�ytkownik zosta� dodany',


/**
 * Mail templates
 */
    'Thanks for registering with'            => 'Dzi�kujemy za zarejestrowanie',
    'username'                               => 'Nazwa u�ytkownika',
    'Dear'                                   => 'Witaj',
    'You are being sent this email because your new account status is now' => 'Otrzyma�e� ten email, poniewa� twoje konto ma teraz status',
    'Click'                                  => 'Kliknij',
    'here'                                   => 'tutaj',
    'to logon to the'                        => 'aby si� zalogowa� do',
    'site now'                               => 'strony.',
    'You are being sent this email because you just registered, your logon details are as follows' => 'Otrzyma�e� ten email poniewa� dokona�e� rejestracji, twoje parametry logowania s� dost�pne poni�ej',
    'Your username is'                       => 'Twoja nazwa u�ytkownika to',
    'Your password is'                       => 'Twoje has�o to',
    'Your registration is being reviewed'    => 'Twoja rejestracja zosta�a przyj�ta, zostaniesz wkr�tce powiadomiony',
    'Password Reminder'                      => 'Przypomnienie has�a',
    'You are being sent this email because'  => 'Otrzyma�e� ten email, poniewa� wybra�e� opcj� przypomnienia has�a.',
    'Your new password is'                   => 'Twoje has�o to',
    'New Registration at'                    => 'Nowa rejestracja w',
    'The following user has just registered' => 'U�ytkownik zosta� zarejestrowany',
    'to enable the new users account'        => 'uruchomienie konta nowego u�ytkownika',

    // not found anywhere, but I suppose, that somewhere it is used
    'There was a problem with your session, please login again'      => 'Czas trwania sesji zosta� przekroczony, prosz� zalogowa� si� ponownie',
    'Only logged on users have access to this area, please register' => 'Tylko zalogowani u�ytkownicy maj� dost�p do tej strefy, prosz� si� zalogowa�',
    'Registration has been disabled'                                 => 'Rejestracja zosta�y wy��czona',
);

?>
