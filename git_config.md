Konfigurujemy dane identyfikacje w Git (jednorazowe)

1. ```git init```
1. ```git config --global user.name "name_from_github"```
1. ```git config --global user.email "user@mail_registered_at_github"```

Konfigurujemy połączenie via SSH (jednorazowe)
    
1. `ssh-keygen -t rsa`
1. `echo -e "\nHost github.com\n\tIdentityFile ~/.ssh/id_rsa" >> ~/.ssh/config`
1. `cat ~/.ssh/id_rsa | pbcopy`, a następnie na github.com dodajemy klucze ssh w zakładce `SSH keys`
1. `ssh -T git@github.com` weryfikujemy identyfikacje użytkownika, poprzez wynik `Hi ad-m! You've successfully authenticated, but GitHub does not provide shell access.`

Inicializujemy projekt

1. `git init`
1. `git remote add origin git@github.com:user_name/repo_name.git` (linki widoczne przy zakładaniu repa)

lub (równoważne)

1. `git clone git@github.com:user_name/repo_name.git .``
    
Przydatne polecenia:
- commit - `git commit -am "opis"`
- push - `git push origin branch_name`
