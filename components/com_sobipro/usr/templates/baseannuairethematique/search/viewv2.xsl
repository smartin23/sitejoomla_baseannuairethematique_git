<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl">
<xsl:output method="xml" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" encoding="UTF-8"/>

<xsl:include href="../common/alphamenu.xsl" />
<xsl:include href="../common/topmenu.xsl" />
<xsl:include href="../common/navigation.xsl" />
<xsl:include href="../common/entries.xsl" />

<xsl:template match="/search">

		<div id="SPSearchForm" 	class="span4">
		
			<div>
			<xsl:apply-templates select="menu" />
			<xsl:apply-templates select="alphaMenu" />
			</div>
	  
			<div style="clear:both;"/>
      
			<!--Recherche Autour de...-->
			<xsl:value-of select="mjradius" disable-output-escaping="yes" />

			<!-- define variable to check if there are more than 3 fields -->
			<xsl:variable name="fieldsCount">
				<xsl:value-of select="count(fields/*)" />
			</xsl:variable>		
			<xsl:choose>
				<!-- if there are more than 3 fields we show the extended search option -->
				<xsl:when test="$fieldsCount &gt; 3">
					<xsl:for-each select="fields/*">
						<!-- output the first 3 fields -->
						<xsl:if test="position() &lt; 4">
				  
						  <!-- directly after the "search" button -->
						  <xsl:if test="position() = 2"><xsl:call-template name="FieldCell" /></xsl:if>
						  
						</xsl:if>
					</xsl:for-each>
 
					<!--Extended Search Fields-->				
					<div id="SPExtSearch" class="customscrollbar">
						<div class="scrollbar">
							<div class="track">
								<div class="thumb">
									<div class="end">
									</div>
								</div>
							</div>
						</div>
						
						<div class="viewport">
							<div class="overview">
            
								<xsl:for-each select="fields/*">
									<xsl:if test="not( name() = 'top_button' )">
									<xsl:call-template name="FieldCell" />
									</xsl:if>

								</xsl:for-each>

								<!-- on ajoute le filtre par catégories-->
								<br/>
								<div class="SPSearchCell">
									<div class="SPSearchLabel">
									  <strong><xsl:text>Filtrer par : </xsl:text></strong>
									</div>
									<div class="SPSearchField">
									  <xsl:value-of select="spcategoriesfilterapp" disable-output-escaping="yes" />
									</div>
								</div>
							</div>  
						</div>
					</div>	  
				</xsl:when>
				<!--<xsl:otherwise>
				  <xsl:for-each select="fields/*">
					<xsl:call-template name="FieldCell" />
					<xsl:if test="name() = 'top_button'">
					  <div style="clear:both;"/>
					</xsl:if>
				  </xsl:for-each>
				</xsl:otherwise>     -->  
			</xsl:choose>
			
			<!--Message de résultats-->
			<xsl:if test="message">
			  <div class="message">
				<xsl:value-of select="message"/>
			  </div>
			</xsl:if>
			
		</div>
		
		<div id="SPSearchResults" class="span8">
	
			
			
			<!--Liste des entrées trouvées-->
			<div class="row-fluid">
				<xsl:call-template name="entriesLoop" />
			</div>
			
			<!--Pagination-->
			<xsl:apply-templates select="navigation" />
		
		</div>

</xsl:template>

<xsl:template name="FieldCell">
	<div class="SPSearchCell">
		<xsl:if test="not( name() = 'top_button' )">
		  <div class="SPSearchLabel">
			<strong><xsl:value-of select="label" /><xsl:text>: </xsl:text></strong>
		  </div>
		</xsl:if>
		<div class="SPSearchField">
		
			<xsl:copy-of select="data/*"/><xsl:text> </xsl:text><xsl:value-of select="@suffix"/>
			<xsl:if test="name() = 'top_button'">
		
				<xsl:variable name="ExOptLabel">
				  <xsl:value-of select="php:function( 'SobiPro::Txt', 'Options' )" />
				</xsl:variable>
				<input id="SPExOptBt" class="button btn" name="SPExOptBt" value="{$ExOptLabel}" type="button"/>
			  
			</xsl:if>
		</div>
	</div>
	<!--<xsl:if test="not( name() = 'searchbox' )">
		<div style="clear:both;"/>
	</xsl:if>-->
</xsl:template>
</xsl:stylesheet>
