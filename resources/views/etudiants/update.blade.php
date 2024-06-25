@extends('base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Créer un étudiant') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('etudiants.update') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Champ Email -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value={{ old('email', Auth::user()->email) }} required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- nom de l'etudiant -->
                        <div class="form-group row">
                            <label for="nom_etude" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>
                            <div class="col-md-6">
                                <input id="nom_etude" type="text" class="form-control @error('nom_etude') is-invalid @enderror" name="nom_etude" value={{ old('nom_etude', Auth::user()->etudiant->nom_etude) }} required>
                                @error('nom_etude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- prenom de l'etudiant -->
                        <div class="form-group row">
                            <label for="prenom_etud" class="col-md-4 col-form-label text-md-right">{{ __('Prénom') }}</label>
                            <div class="col-md-6">
                                <input id="prenom_etud" type="text" class="form-control @error('prenom_etud') is-invalid @enderror" name="prenom_etud" value={{ old('prenom_etud', Auth::user()->etudiant->prenom_etud) }} required>
                                @error('prenom_etud')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- telephonoe de l'etudiant -->
                        <div class="form-group row">
                            <label for="tel_etud" class="col-md-4 col-form-label text-md-right">{{ __('Téléphone') }}</label>
                            <div class="col-md-6">
                                <input id="tel_etud" type="text" class="form-control @error('tel_etud') is-invalid @enderror" name="tel_etud" value={{ old('tel_etud', Auth::user()->etudiant->tel_etud) }} required>
                                @error('tel_etud')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- adress de l'etudiant -->
                        <div class="form-group row">
                            <label for="adress_etud" class="col-md-4 col-form-label text-md-right">{{ __('Adresse') }}</label>
                            <div class="col-md-6">
                                <input id="adress_etud" type="text" class="form-control @error('adress_etud') is-invalid @enderror" name="adress_etud" value={{ old('adress_etud', Auth::user()->etudiant->adress_etud) }} required>
                                @error('adress_etud')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- ville de l'etudiant -->
                        <div class="form-group row">
                            <label for="ville_etud" class="col-md-4 col-form-label text-md-right">{{ __('Ville') }}</label>
                            <div class="col-md-6">
                                <input id="ville_etud" type="text" class="form-control @error('ville_etud') is-invalid @enderror" name="ville_etud" value={{ old('ville_etud', Auth::user()->etudiant->ville_etud) }} required>
                                @error('ville_etud')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- commune de l'etudiant -->
                        <div class="form-group row">
                            <label for="commune_etud" class="col-md-4 col-form-label text-md-right">{{ __('Commune') }}</label>
                            <div class="col-md-6">
                                <select name="commune_etud" value={{ old('email', Auth::user()->etudiant->commune_etud) }} required>
                                    <option value="abobo">Abobo</option>
                                    <option value="adjame">Adjamé</option>
                                    <option value="attecoube">Attécoubé</option>
                                    <option value="cocody">Cocody</option>
                                    <option value="koumassi">Koumassi</option>
                                    <option value="marcory">Marcory</option>
                                    <option value="plateau">Plateau</option>
                                    <option value="port-bouet">Port-Bouët</option>
                                    <option value="treichville">Treichville</option>
                                    <option value="yopougon">Yopougon</option>
                                    <!-- Communes périphériques -->
                                    <optgroup label="Communes périphériques">
                                        <option value="anyama">Anyama</option>
                                        <option value="bingerville">Bingerville</option>
                                        <option value="brofodoume">Brofodoumé</option>
                                        <option value="songon">Songon</option>
                                    </optgroup>

                                  </select>
                                @error('commune_etud')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- date de naissance de l'etudiant -->
                        <div class="form-group row">
                            <label for="date_naiss_etud" class="col-md-4 col-form-label text-md-right">{{ __('Date de naissance') }}</label>
                            <div class="col-md-6">
                                <input id="date_naiss_etud" type="date" class="form-control @error('date_naiss_etud') is-invalid @enderror" name="date_naiss_etud" value={{ old('date_naiss_etud', Auth::user()->etudiant->date_naiss_etud) }} required>
                                @error('date_naiss_etud')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- niveau de l'etudiant -->
                        <div class="form-group row">
                            <label for="niveau_formation_etud" class="col-md-4 col-form-label text-md-right">{{ __('Niveau de formation') }}</label>
                            <div class="col-md-6">
                                <label for="bac">BAC +</label>
                                <input id="niveau_formation_etud" type="number" class="form-control @error('niveau_formation_etud') is-invalid @enderror" name="niveau_formation_etud" value={{ old('etudiant', Auth::user()->etudiant->niveau_formation_etud) }} required>
                                @error('niveau_formation_etud')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- filiere de l'etudiant -->
                        <div class="form-group row">
                            <label for="filiere_etud" class="col-md-4 col-form-label text-md-right">{{ __('Filière') }}</label>
                            <div class="col-md-6">
                                <select name="filiere_etud" id="filiere_etud" value={{ old('filiere_etud', Auth::user()->etudiant->filiere_etud) }} required>
                                    <optgroup label="BTS">
                                        <option value="tourisme et hôtellerie" name="bts_th">Tourisme et Hôtellerie</option>
                                        <option value="comptabilité" name="bts_cf">Comptabilité</option>
                                        <option value="informatique développeur d'application" name="bts_ida">Informatique Développeur d'Application</option>
                                        <option value="assistanat de direction"name="bts_ad">Assistanat de Direction</option>
                                        <option value="communication et ressources humaines" name="bts_rh">Communication et Ressources Humaines</option>
                                        <option value="gestion commerciale" name="bts_gc">Gestion Commerciale</option>
                                    </optgroup>

                                    <optgroup label="Licence Professionnelle">
                                        <option value="audit et contrôle de gestion" name="lp_acg">Audit et Contrôle de Gestion</option>
                                        <option value="comptabilité" name="lp_cf">Comptabilité Finance</option>
                                        <option value="réseau génie logiciel" name="lp_rgl">Réseau Génie Logiciel</option>
                                        <option value="assistanat de direction"name="lp_ad">Assistanat de Direction</option>
                                        <option value="communication et ressources humaines" name="lp_rh">Communication et Ressources Humaines</option>
                                        <option value="gestion des entreprises" name="lp_gc">Gestion des Entreprises</option>
                                        <option value="marketing" name="lp_ma">Marketing</option>
                                        <option value="gestion des ressources humaines" name="lp_grh">Gestion des Ressources Humaines</option>
                                    </optgroup>
                                    <optgroup label="Master Professionnel">
                                        <option value="administration des entreprises" name="mp_ae">Administration des Entreprises</option>
                                        <option value="audit et contrôle de gestion" name="mp_acg">Audit et Contrôle de Gestion</option>
                                        <option value="finance comptabilité" name="mp_fc">Finance Comptabilité</option>
                                        <option value="fiscalité et droit des affaires" name="mp_fda">Fiscalité et Droit des Affaires</option>
                                        <option value="marketing" name="mp_ae">Marketing</option>
                                        <option value="génie informatique" name="mp_gi">Génie Informatique</option>
                                    </optgroup>
                                </select>
                                @error('filiere_etud')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cv_path" class="col-md-4 col-form-label text-md-right">{{ __('CV') }}</label>
                            <div class="col-md-6">
                                <input id="cv_path" type="file" class="form-control @error('cv_path') is-invalid @enderror" name="cv_path" required>
                                @error('cv_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Créer') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
