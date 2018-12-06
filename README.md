# 301-nobots
Script permettant de mettre en place une redirection 301 vers un nouveau domaine en obfusquant la redirection pour les différents Crawler Web (Majestic, AHref, SemRush...).

# Utilisation
- Importez le script sur votre serveur FTP.
- Assurez-vous que le mod_rewrite d'apache est bien activé.
- Modifier le fichier de configuration selon vos besoins

# Configuration
Pour modifier la configuration du script, utilisez le fichier config.json

## redirectTo
Indiquez le site vers lequel vous souhaitez envoyer le trafic

## mod
Plusieurs modes de cloacking sont à votre disposition.

### UA-BCC (User-Agent Block Common Crawler)
Bloc les crawler des outils d'analyse SEO tel que Majestic, SEMRush, AHref en fonction de l'User-Agent utilisé par le crawler. La liste des User-Agent est disponible et éditable dans le fichier ./d/blocked_ua.txt (utilise une expression régulière et non pas une comparaison exacte)

```
{
	"redirectTo": "https://www.domain.tld",
	"mod": "UA-BCC"
}
```

### UA-AC (User-Agent Allow Crawler)
Ne génère une redirection que pour les User-Agent autorisés dans le fichier authorized_ua.txt (utilise une expression régulière et non pas une comparaison exacte)

```
{
	"redirectTo": "https://www.domain.tld",
	"mod": "UA-AC"
}
```

### IP-AC (IP Allow Crawler)
Ne génère une redirection que pour les IP indiquées dans le fichier authorized_ip.txt (utilise une comparaison exacte)

```
{
	"redirectTo": "https://www.domain.tld",
	"mod": "IP-AC"
}
```

### RDNS-AC (Reverse DNS Authorized Crawler)
Ne génère une redirection que pour les crawler dont le nom d'hôte est dans la liste autorisée dans le fichier ./d/authorized_host.txt (utilise une expression régulière et non pas une comparaison exacte)

```
{
	"redirectTo": "https://www.domain.tld",
	"mod": "RDNS-AC"
}
```

# Plus d'information
Vous souhaitez mettre en place une stratégie de référencement naturel ? Faites appel à mes services de [consultant seo](https://www.trimardeau.com/)