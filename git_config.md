W KATALOGU GDZIE MA BYĆ LOKALNE REPO GIT:

    1. git init
    2. git config --global user.name "name_from_github"
    3. git config --global user.email "user@mail_registered_at_github"
    4. git init

ZAKŁADAMY KATALOG KLUCZY SSH I W TYM KATALOGU:
    
    1. ssh-keygen -t rsa -C mail_podany_przy_git_--config (pkt. 3 powyżej)
        (tu wygenerujemy klucz o nazwie "nazwa_klucza_ssh" i ewentualnie podamy jego hasła)
    2. ssh-agent
    3. eval "$(ssh-agent)"
    4. ssh-add nazwa_klucza_ssh
    5. na github.com dodajemy klucze ssh w zakładce SSH keys
    6. ssh -T -p 443 git@ssh.github.com
        (from man ssh:
        -T      Disable pseudo-tty allocation.
        -p port
             Port to connect to on the remote host.  This can be specified on
             a per-host basis in the configuration file.
        )

DODAJEMY REPA:
    
    1. git add path_do_repa (lokalne)
    2. git remote add origin https://github.com/nasz_user_nagithub/nazwa_repa_na_github.git (linki widoczne przy zakładaniu repa)
    
COMMIT:

    git commit -am "opis"
    
PUSH:

    git push origin master (lub nazwa brancha)
    
