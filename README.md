FecBundle
=========

FecBundle allows generation of FEC files and reading data from FEC files.

FEC stands for "fichier d'écritures comptables" and is specific to french accounting.

FEC files are standardized. Theire are four formats that french accounting standard accept :

- flat file CSV with tab separator
- flat file CSV with pipe separator (|)
- flat file with fixed width columns
- XML file following XSD spec

**This bundle can currently produce and read the two first type : flat file CSV tab or pipe separator**, but can be extended to plug an adapter of your own to produce the XML or flat fixed width column format.

A FEC file, whatever its type, must have at least 18 fields by accounting line, but it can be 21 or 22 columns.

**18 columns** :

- BIC / IS : industrial and commercial profits / company tax
- BNC/BA Droit commercial : non commercial and agricultural profits in trade law

**21 columns** :

- BA trésorerie : agricultural profits treasury

**22 columns** :

- BNC trésorerie : non commercial profits treasury

All fields are standardized, even if Debit and Credit fields can be switched by Montant (amount) and Sens (direction, which can be D/C or +1/-1).

**Note** : this bundle does not generate the associated textual description file.

# Installation #

Use composer

    php composer.phar require "a5sys/fec-bundle:dev-master"

or

    composer require "a5sys/fec-bundle:dev-master"

Declare bundle in `AppKernel.php` :

    new A5sys\FecBundle\FecBundle(),

# configure #

**config.yml**

You can configure the default temp dir for the generation of FEC files:

    fec:
        defaultTempDir: /a/writable/path

if **not set**, the bundle will use the **system temp dir**.

# Compose and use the FEC generator service #

## Compose ##

To generate FEC files, declare a service, using the pre-configured class in the parameter fec.manager.class.

**services.yml**

    fec.manager.my:
        class: %fec.manager.class%
        arguments:
            - %fec.defaultTempDir%
            - "@fec.dumper.csv.tab.txt"
            - "@fec.normalizer.bic.is"
            - "@fec.computer.debitcredit"

- **Argument 1**
	- the fec.defaultTempDir parameter should not be modified here, prefer modify the parameter in config.yml

The 3 last arguments are the services you should carefuly choose to generate the right FEC file:

- **Argument 2**
	- In the example : "@fec.dumper.csv.tab.txt"
	- The following are currently provided:
		- "@fec.dumper.csv.tab.txt"
			- CSV file with **tab** separator and **.txt** extension
		- "@fec.dumper.csv.pipe.txt"
		    - CSV file with **|** separator and **.txt** extension
- **Argument 3**
	- In the example "@fec.normalizer.bic.is"
	- The following are currently provided:
		- **"@fec.normalizer.bic.is"**
			- Use input objects of type
				- EcritureBICIS
				- an instance of AbstractEcritureComptable
				- an instance of EcritureComptableInterface.
			- For accounting entries with 18 columns
		- **"@fec.normalizer.bnc.ba.dc"**
			- Use input objects of type
				- EcritureBNCBADroitCommercial
				- an instance of AbstractEcritureComptable
				- an instance of EcritureComptableInterface.
			- For accounting entries with 18 columns
		- **"@fec.normalizer.ba.tresorerie"**
			- Use input objects of type
				- EcritureBATresorerie
				- an instance of EcritureBATresorerieInterface
			- For accounting entries with 21 columns
		- **"@fec.normalizer.bnc.tresorerie"**
			- Use input objects of type
				- EcritureBNCTresorerie
				- an instance of EcritureBNCTresorerieInterface
			- For accounting entries with 22 columns
- **Argument 4**
	- In the example "@fec.computer.debitcredit"
	- The following are currently provided:
		- **"@fec.computer.debitcredit"**
			- To produce the fields **Debit** and **Credit**, amount in one of the two
		- **"@fec.computer.montantsens.alpha"**
			- To produce the fields **Montant** and **Sens**
			- With D and C into Sens
		- **"@fec.computer.montantsens.num"**
		    - To produce the fields **Montant** and **Sens**
			- With +1 for debit and -1 for credit into Sens

## Use ##

In a controller :

        $fecLines = [];
        foreach ($ecritureLignes as $ecritureLigne) {
            $fecLine = new \A5sys\FecBundle\ValueObject\EcritureBICIS();
            $fecLine
                ->setJournalCode($jCode)
                ->setJournalLib($jLib)
                ->setEcritureNum($eNum)
                ->setEcritureDate($eDate)
                ->setCompteNum($cNum)
                ->setCompteLib($cLib)
                ->setCompAuxNum($caNum)
                ->setCompAuxLib($caLib)
                ->setPieceRef($numeroPiece)
                ->setPieceDate($datePiece)
                ->setEcritureLib($eLib)
                ->setDebit($debit)
                ->setCredit($credit)
                ->setEcritureLet($eLet)
                ->setDateLet($dLet)
                ->setValidDate($dateValid)
                ->setMontantdevise($mDev)
                ->setIdevise($iDev)
            ;

            $fecLines[] = $fecLine;
        }

        $this->get('fec.manager.my')->generateFile($sirenNumber, $dateCloture, $fecLines)

In a service :

Simply inject your "fec.manager.my" in an an other service of your.

**Notes**:

The manager needs the siren and closing date to produce the right file name, as it is conventionned too.

All Input objects specify the Debit and Credit, and not the Montant and Sens, the output format, in the file, can be choosen, but not the input method.

**Input objects and mandatory fields**

EcritureBICIS, EcritureBNCBADroitCommercial, and more widely all EcritureComptableInterface, must have a value for those fields:

- JournalCode
- JournalLib
- EcritureNum
- EcritureDate
- CompteNum
- CompteLib
- PieceRef
- PieceDate
- EcritureLib
- ValidDate

EcritureBATresorerie, EcritureBNCTresorerie, and interfaces EcritureBATresorerieInterface, EcritureBNCTresorerieInterface, must provide a value for those additionnal fields

- DateRglt
- ModeRglt

## Change file extension ##

**services.yml**

declare an other service like this, to get a CSV file with **pipe** separator and "**.fec**" extension:

    fec.dumper.csv.pipe.fec:
        class: %fec.dumper.csv.class%
        arguments:
            - "|"
            - "fec"

Use now the "@fec.dumper.csv.pipe.fec" service in the fec.manager.my definition in services.yml.

# Compose and use the FEC reader service #

## Compose ##

To read FEC files, declare a service, using the pre-configured class in the parameter fec.manager.class.

**services.yml**

    fec.reader.my:
        class: %fec.reader.class%
        arguments:
            - "@fec.dumper.csv.tab.txt"
            - "@fec.normalizer.standard"
            - "@fec.computer.debitcredit"

The 3 last arguments are the services you should carefuly choose to generate the right FEC file:

- **Argument 1**
	- In the example : "@fec.dumper.csv.tab.txt"
	- The following are currently provided:
		- "@fec.reader.csv.tab"
			- CSV file with **tab** separator
		- "@fec.dumper.csv.pipe"
		    - CSV file with **|** separator
- **Argument 2**
	- In the example "@fec.normalizer.standard"
	- The following are currently provided:
		- **"@fec.normalizer.bic.is"**
			- Produce objects of type
				- EcritureBICIS
			- For accounting entries with 18 columns
		- **"@fec.normalizer.bnc.ba.dc"**
			- Produce objects of type
				- EcritureBNCBADroitCommercial
			- For accounting entries with 18 columns
		- **"@fec.normalizer.ba.tresorerie"**
			- Produce objects of type
				- EcritureBATresorerie
			- For accounting entries with 21 columns
		- **"@fec.normalizer.bnc.tresorerie"**
			- Produce objects of type
				- EcritureBNCTresorerie
			- For accounting entries with 22 columns
- **Argument 3**
	- In the example "@fec.computer.debitcredit"
	- The following are currently provided:
		- **"@fec.computer.debitcredit"**
			- To produce the fields **Debit** and **Credit**, amount in one of the two
		- **"@fec.computer.montantsens.alpha"**
			- To produce the fields **Montant** and **Sens**
			- With D and C into Sens
		- **"@fec.computer.montantsens.num"**
		    - To produce the fields **Montant** and **Sens**
			- With +1 for debit and -1 for credit into Sens

## Use ##

In a controller :

	/**
     * Import a FEC file
     *
     * @param Request $request
     *
     * @Route("/import/fec", name="import_fec")
     */
    public function importFecAction(Request $request): Response
    {
        // get the uploaded file. With Symfony you directly get a UploadedFile which extends File
        $uploadedFile = $request->files->get('file');

        // Get the list of A5sys\FecBundle\ValueObject\EcritureBICIS by giving a File to the service you've just composed
        $ecrituresComptables = $this->get('fec.reader.expertim')->readFile($uploadedFile);

		...
	}
In a service :

Simply inject your "fec.reader.my" in an an other service of your.

**Validation**

When reading the CSV FEC file, a check is done on the well formed aspect of all the lines.

When the number of columns of a line is not the same as the number of headers, a FecException is thrown.
If a Date field is not Ymd formatted, a FecException is thrown.
If a numeric field is not numeric, a FecException is throw.

Further details, see CsvReader class.

Then, when the ValueObject (EcritureXxx) is created, the validator checks it and may throw a FecValidationException if data does not respect the french specification.

# References #
https://www.legifrance.gouv.fr/affichTexte.do?cidTexte=JORFTEXT000027788276&dateTexte=&categorieLien=id